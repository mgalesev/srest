<?php

namespace SoulDock\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoulDockUserBundle:Default:index.html.twig');
    }
}
