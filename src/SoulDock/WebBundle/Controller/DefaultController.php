<?php

namespace SoulDock\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SoulDock\PaperBundle\Form\PaperTypeType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('SoulDockWebBundle:Default:index.html.twig');
    }
}
