<?php

namespace SoulDock\PaperBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\Request;
use SoulDock\PaperBundle\Form\PaperTypeType;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcherInterface;

/**
 * Class PaperTypeController
 *
 * @package SoulDock\PaperBundle\Controller
 */
class PaperTypeController extends BaseRestController
{
    /**
     * { @inheritdoc }
     */
    protected function getManager()
    {
        return $this->get('paper_type.manager');
    }

    /**
     *
     * @View()
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPapertypeAction($id)
    {
        $data = $this->findOr404($id);

        return $this->ok($data);
    }

    /**
     * @QueryParam(name="limit", requirements="\d+", default="10", description="our limit")
     * @QueryParam(name="offset", requirements="\d+", nullable=true, default="0", description="our offset")
     *
     * @param Request               $request
     * @param ParamFetcherInterface $paramFetcher
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPapertypesAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $limit = $paramFetcher->get('limit');
        $offset = $paramFetcher->get('offset');

        $data = $this->getManager()->findAll(array(), array(), $limit, $offset);

        return $this->ok($data);
    }

    /**
     * Post action.
     *
     * @View()
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postPapertypeAction(Request $request)
    {
        $entity = $this->getManager()->createNew();

        return $this->handleForm(
            PaperTypeType::class,
            $entity,
            $request,
            'POST'
        );
    }

    /**
     * Put action
     *
     * @View()
     *
     * @param Request $request
     * @param int     $id
     *
     * @return mixed
     */
    public function putPapertypeAction(Request $request, $id)
    {
        $entity = $this->findOr404($id);

        return $this->handleForm(
            PaperTypeType::class,
            $entity,
            $request,
            'PUT'
        );
    }

    /**
     * Patch action
     *
     * @param Request $request
     * @param int     $id
     *
     * @return mixed
     */
    public function patchPapertypeAction(Request $request, $id)
    {
        $entity = $this->findOr404($id);

        return $this->handleForm(
            PaperTypeType::class,
            $entity,
            $request,
            'PATCH'
        );
    }

    /**
     * Delete action
     *
     * @param int $id Entity ID
     *
     * @return View
     */
    public function deletePapertypeAction($id)
    {
        $entity = $this->findOr404($id);

        $this->getManager()->delete($entity);

        return $this->ok(null);
    }
}