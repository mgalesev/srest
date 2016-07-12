<?php

namespace SoulDock\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SoulDock\PaperBundle\Form\PaperType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $form = $this->createForm(PaperType::class);

        return $this->render('SoulDockTagBundle:Default:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
