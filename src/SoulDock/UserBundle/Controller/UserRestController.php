<?php

namespace SoulDock\UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use SoulDock\RestBundle\Controller\BaseRestController;
use Symfony\Component\HttpFoundation\Request;
use SoulDock\UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
 * Class UserRestController
 *
 * @package SoulDock\UserBundle\Controller
 */
class UserRestController extends BaseRestController
{
    /**
     * { @inheritdoc }
     */
    public function getEntityManager()
    {
        return $this->get('fos_user.user_manager');
    }

    /**
     * { @inheritdoc }
     */
    public function getFormClass()
    {
        UserType::class;
    }

    /**
     * Create new User action.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Register a new User",
     *  input = "SoulDock\UserBundle\Form\UserType",
     *  output = "SoulDock\UserBundle\Entity\User",
     *  section="User",
     *  statusCodes={
     *         201="Returned when a new User has been successfully created",
     *         400="Returned when the posted data is invalid"
     *     }
     * )
     *
     * @param Request $request
     *
     * @return View
     */
    public function postUserAction(Request $request)
    {
        $dispatcher = $this->get('event_dispatcher');

        $user = $this->getEntityManager()->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm(UserType::class, $user, [
            'method' => Request::METHOD_POST,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $this->getEntityManager()->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $this->created($user);
        }
        else {
            return $this->bad($form);
        }
    }
}