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
use SoulDock\UserBundle\Form\Type\ChangePasswordFormType;
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
     * Change password action.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Confirm a new User",
     *  input = "SoulDock\UserBundle\Form\Type\ChangePasswordFormType",
     *  output = "SoulDock\UserBundle\Entity\User",
     *  section="User",
     *  statusCodes={
     *         200="Returned when a new User has been successfully confirmed",
     *         404="Returned when user with posted token is not found"
     *     }
     * )
     *
     * @param Request $request
     *
     * @return View
     */
    public function patchUserChangepasswordAction(Request $request)
    {
        $user = $this->getUser();

        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(
            FOSUserEvents::CHANGE_PASSWORD_INITIALIZE,
            $event
        );

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm(ChangePasswordFormType::class, $user, [
            'method' => Request::METHOD_PATCH,
            'csrf_protection' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(
                FOSUserEvents::CHANGE_PASSWORD_SUCCESS,
                $event
            );

            $this->getEntityManager()->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(
                FOSUserEvents::CHANGE_PASSWORD_COMPLETED,
                new FilterUserResponseEvent($user, $request, $response)
            );

            return $this->ok($user);
        }
        else {
            return $this->bad($form);
        }
    }

}