<?php

namespace SoulDock\PaperBundle\Controller;

use SoulDock\PaperBundle\Service\SoulDockEntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class BaseRestController
 *
 * @package SoulDock\PaperBundle\Controller
 */
abstract class BaseRestController extends FOSRestController
{
    /**
     * Get entity manager.
     *
     * @return SoulDockEntityManagerInterface
     */
    abstract protected function getManager();

    /**
     * Return 200
     *
     * @param $data
     *
     * @return View
     */
    protected function ok($data)
    {
        return $this->view($data, Codes::HTTP_OK);
    }

    /**
     * Return 201
     *
     * @param object $data
     *
     * @return View
     */
    protected function created($data)
    {
        return $this->view($data, Codes::HTTP_CREATED);
    }

    /**
     * Return 404
     *
     * @return View
     */
    protected function notFound()
    {
        return $this->view(null, Codes::HTTP_NOT_FOUND);
    }

    /**
     * Return 400
     *
     * @param $data
     *
     * @return view
     */
    protected function bad($data)
    {
        return $this->view($data, Codes::HTTP_BAD_REQUEST);
    }

    /**
     * Find entity by ID of throw 404.
     *
     * @param int $id Entity ID
     *
     * @return mixed
     */
    protected function findOr404($id)
    {
        $data = $this->getManager()->find($id);

        if (empty($data)) {
            throw new NotFoundHttpException();
        }

        return $data;
    }

    /**
     * Handle form submition, validation and entity managment.
     *
     * @param string  $formClass Form class name
     * @param object  $entity    Entity
     * @param Request $request   Request parameters
     * @param string  $method    HTTP Method (POST|PUT|PATCH)
     *
     * @return mixed
     */
    protected function handleForm($formClass, $entity, $request, $method)
    {
        if (empty($entity)) {
            return $this->notFound();
        }

        $form = $this->createForm($formClass, $entity, array(
            'method'            => $method,
            'csrf_protection'   => false,
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $this->getManager()->save($data);

            if ($method == 'POST') {
                return $this->created($data);
            }
            else {
                return $this->ok($data);
            }
        }
        else {
            return $this->bad($form);
        }
    }
}