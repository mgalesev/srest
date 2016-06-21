<?php

namespace SoulDock\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SoulDock\PaperBundle\Form\PaperTypeType;
use Symfony\Component\HttpFoundation\Request;
use SoulDock\UserBundle\Form\UserType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm(UserType::class);
        return $this->render('SoulDockWebBundle:Default:index.html.twig');
    }
}
