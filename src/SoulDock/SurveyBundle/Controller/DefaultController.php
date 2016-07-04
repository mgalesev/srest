<?php

namespace SoulDock\SurveyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoulDockSurveyBundle:Default:index.html.twig');
    }
}
