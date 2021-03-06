<?php

namespace SoulDock\PaperBundle\Controller;

use SoulDock\RestBundle\Controller\BaseRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\Request;
use SoulDock\PaperBundle\Form\PaperTypeType;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class PaperTypeController
 *
 * @package SoulDock\PaperBundle\Controller
 */
class PaperTypeController extends BaseRestController
{
    /**
     * Get all action
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Returns a collection of PaperTypes",
     *  section="PaperType",
     *  requirements={
     *      {"name"="limit", "dataType"="integer", "requirement"="\d+", "description"="the max number of records to return"}
     *  },
     *  parameters={
     *      {"name"="limit", "dataType"="integer", "required"=true, "description"="the max number of records to return"},
     *      {"name"="offset", "dataType"="integer", "required"=false, "description"="the record number to start results at"}
     *  }
     * )
     *
     * @QueryParam(name="limit", requirements="\d+", default="10", description="our limit")
     * @QueryParam(name="offset", requirements="\d+", nullable=true, default="0", description="our offset")
     *
     * @param int $limit  Number of entities returned
     * @param int $offset Start form this entity number
     *
     * @return View
     */
    public function getPapertypesAction($limit, $offset)
    {
        return $this->getAllAction([], [], $limit, $offset);
    }

    /**
     * Get sindle Paper Type
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retrieves an PaperType by id",
     *  output = "SoulDock\PaperBundle\Entity\PaperType",
     *  section="PaperType",
     *   requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper Type to return"}
     *   },
     *  statusCodes={
     *         200="Returned when successful",
     *         404="Returned when the requested Artist is not found"
     *     }
     * )
     *
     * @param $id
     *
     * @return View
     */
    public function getPapertypeAction($id)
    {
        return $this->getAction($id);
    }

    /**
     * Create new PaperType action.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Creates a new PaperType",
     *  input = "SoulDock\PaperBundle\Form\PaperTypeType",
     *  output = "SoulDock\PaperBundle\Entity\PaperType",
     *  section="PaperType",
     *  statusCodes={
     *         201="Returned when a new PaperType has been successfully created",
     *         400="Returned when the posted data is invalid"
     *     }
     * )
     *
     * @param Request $request
     *
     * @return View
     */
    public function postPapertypeAction(Request $request)
    {
        return $this->postAction($request);
    }

    /**
     * Update existing Paper Type from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "SoulDock\PaperBundle\Form\PaperTypeType",
     *   output = "SoulDock\PaperBundle\Entity\PaperType",
     *   section="PaperType",
     *   requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper Type to update"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors",
     *     404 = "Returned when resource was not found"
     *   }
     * )
     *
     *
     * @param Request $request The request object
     * @param int     $id      The Paper Type id
     *
     * @return View
     */
    public function putPapertypeAction(Request $request, $id)
    {
        return $this->putAction($request, $id);
    }

    /**
     * Update only passed fields on existing Paper Type from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "SoulDock\PaperBundle\Form\PaperTypeType",
     *   output = "SoulDock\PaperBundle\Entity\PaperType",
     *   section="PaperType",
     *   requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper Type to update"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors",
     *     404 = "Returned when resource was not found"
     *   }
     * )
     *
     * @param Request $request The request object
     * @param int     $id      The paper type id
     *
     * @return View
     */
    public function patchPapertypeAction(Request $request, $id)
    {
        return $this->patchAction($request, $id);
    }

    /**
     * Delete PaperType.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Deletes an existing PaperType",
     *  section="PaperType",
     *  requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper Type to delete"}
     *  },
     *  statusCodes={
     *         200="Returned when an existing PaperType has been successfully deleted",
     *         404="Returned when trying to delete a non existent PaperType"
     *     }
     * )
     *
     * @param int $id The paper type id
     *
     * @return View
     */
    public function deletePapertypeAction($id)
    {
        return $this->deleteAction($id);
    }

    /**
     * { @inheritdoc }
     */
    protected function getEntityManager()
    {
        return $this->get('paper_type.manager');
    }

    /**
     * { @inheritdoc }
     */
    protected function getFormClass()
    {
        return PaperTypeType::class;
    }
}