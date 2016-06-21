<?php

namespace SoulDock\UserBundle\Mailer;

use FOS\UserBundle\Mailer\TwigSwiftMailer;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class UserMailer
 *
 * @package SoulDock\UserBundle\Mailer
 */
class UserMailer extends TwigSwiftMailer
{

    /**
     * Overriden to change confirmation url.
     *
     * @param UserInterface $user
     */
    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['template']['confirmation'];
        $url = sprintf('%s?token=%s', $this->parameters['url']['confirmation'], $user->getConfirmationToken());

        $context = array(
            'user' => $user,
            'confirmationUrl' => $url,
        );

        $this->sendMessage($template, $context, $this->parameters['from_email']['confirmation'], $user->getEmail());
    }

}