<?php

namespace SoulDock\PaperBundle\Controller;

use SoulDock\RestBundle\Controller\BaseRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use SoulDock\PaperBundle\Form\PaperType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PaperController
 *
 * @package SoulDock\PaperBundle\Controller
 */
class PaperController extends BaseRestController
{
    /**
     * Get all action
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Returns a collection of Papers",
     *  section="Paper",
     *  requirements={
     *      {"name"="limit", "dataType"="integer", "requirement"="\d+", "description"="the max number of records to return"}
     *  },
     *  parameters={
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="the max number of records to return"},
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
    public function getPapersAction($limit, $offset)
    {
        return $this->getAllAction([], [], $limit, $offset);
    }

    /**
     * Get sindle Paper.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retrieves an Paper by id",
     *  output = "SoulDock\PaperBundle\Entity\Paper",
     *  section="Paper",
     *   requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper to return"},
     *      {"name"="language", "dataType"="string", "requirement"="en|fr|es|pt", "description"="Language"}
     *   },
     *  statusCodes={
     *         200="Returned when successful",
     *         404="Returned when the requested Paper is not found"
     *     }
     * )
     *
     * @QueryParam(name="language", requirements="en|fr|es|pt", default="en", description="Language")
     *
     * @return View
     */
    public function getPaperAction(Request $request, $id, $language)
    {
        $paper = $this->getEntityManager()->findPaperTranslation($id, $language);

        if ($paper) {
            $view = $this->cachedResponse($paper, $request);
        }
        else {
            $view = $this->notFound();
        }

        return $view;
    }

    /**
     * Create new Paper action.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Creates a new Paper",
     *  input = "SoulDock\PaperBundle\Form\PaperType",
     *  output = "SoulDock\PaperBundle\Entity\Paper",
     *  section="Paper",
     *  statusCodes={
     *         201="Returned when a new Paper has been successfully created",
     *         400="Returned when the posted data is invalid"
     *     }
     * )
     *
     * @param Request $request
     *
     * @return View
     */
    public function postPaperAction(Request $request)
    {
        return $this->postAction($request);
    }

    /**
     * Update existing Paper from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "SoulDock\PaperBundle\Form\PaperType",
     *   output = "SoulDock\PaperBundle\Entity\Paper",
     *   section="Paper",
     *   requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper to update"}
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
     * @param int     $id      The Paper id
     *
     * @return View
     */
    public function putPaperAction(Request $request, $id)
    {
        return $this->putAction($request, $id);
    }

    /**
     * Update only passed fields on existing Paper from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "SoulDock\PaperBundle\Form\PaperType",
     *   output = "SoulDock\PaperBundle\Entity\Paper",
     *   section="Paper",
     *   requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper to update"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors",
     *     404 = "Returned when resource was not found"
     *   }
     * )
     *
     * @param Request $request The request object
     * @param int     $id      The paper id
     *
     * @return View
     */
    public function patchPaperAction(Request $request, $id)
    {
        return $this->patchAction($request, $id);
    }

    /**
     * Delete Paper.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Deletes an existing Paper",
     *  section="Paper",
     *  requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="the id of the Paper to delete"}
     *  },
     *  statusCodes={
     *         200="Returned when an existing Paper has been successfully deleted",
     *         404="Returned when trying to delete a non existent Paper"
     *     }
     * )
     *
     * @param int $id The Paper id
     *
     * @return View
     */
    public function deletePaperAction($id)
    {
        return $this->deleteAction($id);
    }

    /**
     * { @inheritdoc }
     */
    protected function getEntityManager()
    {
        return $this->get('paper.manager');
    }


    /**
     * { @inheritdoc }
     */
    protected function getFormClass()
    {
        return PaperType::class;
    }
}