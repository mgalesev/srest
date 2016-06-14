<?php

namespace SoulDock\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoulDockRestBundle:Default:index.html.twig');
    }
}
