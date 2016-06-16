<?php

namespace SoulDock\RestBundle\Controller;

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
 * @package SoulDock\RestBundle\Controller
 */
abstract class BaseRestController extends FOSRestController
{
    /**
     * Get entity manager for resource
     *
     * @return SoulDockEntityManagerInterface
     */
    abstract protected function getEntityManager();

    /**
     * Get form class for resource.
     *
     * @return string
     */
    abstract protected function getFormClass();

    /**
     * Find all entity data by given criterias.
     *
     * @param array $filter List of filters to filter by
     * @param array $order  List of sort=>direction pairs to order by
     * @param int   $limit  Number of results to return
     * @param int   $offset Number to start from
     *
     * @return View
     */
    protected function getAllAction($filter, $order, $limit, $offset)
    {
        $data = $this->getEntityManager()->findAll($filter, $order, $limit, $offset);
        $total = $this->getEntityManager()->count($filter);

        $view = $this->ok($data);
        $view->setHeader('X-Total-Count', $total);

        return $view;
    }

    /**
     * Returns representation of single entity.
     *
     * @param int $id Identifier of entity to return
     *
     * @return View
     *
     * @throws NotFoundHttpException
     */
    protected function getAction($id)
    {
        $data = $this->findOr404($id);

        return $this->ok($data);
    }

    /**
     * Creates new entity and returns representation of that entity
     *
     * @param Request $request
     *
     * @return View
     */
    protected function postAction(Request $request)
    {
        $entity = $this->getEntityManager()->createNew();

        return $this->handleForm(
            $this->getFormClass(),
            $entity,
            $request,
            Request::METHOD_POST
        );
    }

    /**
     * Update all fields of entity with given id and returns updated representation of that entity.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return View
     *
     * @throws NotFoundHttpException
     */
    protected function putAction(Request $request, $id)
    {
        $entity = $this->findOr404($id);

        return $this->handleForm(
            $this->getFormClass(),
            $entity,
            $request,
            Request::METHOD_PUT
        );
    }

    /**
     * Update passed fields of entity with given id and returns updated representation of that entity.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return View
     *
     * @throws NotFoundHttpException
     */
    protected function patchAction(Request $request, $id)
    {
        $entity = $this->findOr404($id);

        return $this->handleForm(
            $this->getFormClass(),
            $entity,
            $request,
            Request::METHOD_PATCH
        );
    }

    /**
     * Delete entity with given identifier.
     *
     * @param int $id
     *
     * @return View
     *
     * @throws NotFoundHttpException
     */
    protected function deleteAction($id)
    {
        $entity = $this->findOr404($id);

        $this->getEntityManager()->delete($entity);

        return $this->ok(null);
    }

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
        $data = $this->getEntityManager()->find($id);

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
            $this->getEntityManager()->save($data);

            if ($method == Request::METHOD_POST) {
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