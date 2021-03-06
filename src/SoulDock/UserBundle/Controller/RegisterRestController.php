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
 * Class RegisterRestController
 *
 * @package SoulDock\UserBundle\Controller
 */
class RegisterRestController extends BaseRestController
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
     *  section="Register",
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
    public function postRegisterUserAction(Request $request)
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

    /**
     * Confirm User action.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Confirm a new User",
     *  section="Register",
     *  statusCodes={
     *         200="Returned when a new User has been successfully confirmed",
     *         404="Returned when user with posted token is not found"
     *     }
     * )
     *
     * @param Request $request
     * @param string  $token
     *
     * @return View
     */
    public function patchRegisterConfirmAction(Request $request, $token)
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
             return $this->notFound();
        }

        $dispatcher = $this->get('event_dispatcher');

        $user->setConfirmationToken(null);
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRM, $event);

        $userManager->updateUser($user);
        $response = $event->getResponse();

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRMED, new FilterUserResponseEvent($user, $request, $response));

        return $this->ok($user);
    }
}