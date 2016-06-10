<?php
/**
 * Created by PhpStorm.
 * User: milan
 * Date: 6/10/16
 * Time: 10:45 AM
 */

namespace SoulDock\PaperBundle\Form\Handler;

use Symfony\Component\Form\FormFactoryInterface;

class FormHandler
{
    private $formFactory;
    private $entityManager;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param $formClass
     * @param $object
     * @param $request
     * @param string $method HTTP Method(POST|PUT|PATCH)
     *
     * @return object|\Symfony\Component\Form\FormInterface
     */
    public function processForm($formClass, $object, $request, $method)
    {
        $form = $this->formFactory->create($formClass, $object, array(
            'method'            => $method,
            'csrf_protection'   => false,
        ));

        $form->submit($request->request->all(), 'PATCH' !== $method);

        if ($form->isValid()) {
            $this->em->save($object);

            return $object;
        }
        else {
            return $form;
        }
    }
}