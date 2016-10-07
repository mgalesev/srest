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
        $form = $this->createForm('tag_area');
        return $this->render('SoulDockWebBundle:Default:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function loadPaperAction($id, $language)
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $paper = $em->getRepository('SoulDockPaperBundle:Paper')->findTranslated($id, $language);

        return $this->render('SoulDockWebBundle:Default:paper.html.twig', [
            'paper' => $paper,
        ]);
    }
}
