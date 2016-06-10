<?php

namespace SoulDock\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SoulDock\PaperBundle\Form\PaperTypeType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        $paperManager = $this->get('paper_type.manager');
        $paperTypes = $paperManager->findAll(array(), array(), 100, 0);
        $paperType = $paperManager->createNew();
//
        $form = $this->createForm(PaperTypeType::class, $paperType);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $paperManager->save($paperType);
//        }
//        else {
//            dump($form->getErrors(true,false));die;
//        }

        return $this->render('SoulDockWebBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
