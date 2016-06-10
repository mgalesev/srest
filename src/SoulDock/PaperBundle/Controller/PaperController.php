<?php

namespace SoulDock\PaperBundle\Controller;

use FOS\RestBundle\Controller\Annotations;

class PaperController extends BaseRestController
{

    protected function getManager()
    {
        // TODO: Implement getManager() method.
    }

    /**
     * @Annotations\View(templateVar="paper")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPaperAction($id)
    {
        $data = $this->get('paper.manager')->findPaper($id);

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    public function getPapersAction()
    {
        $data = $this->get('paper.manager')->findAllPapers();

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    public function postPaperAction()
    {

    }

    public function putPaperAction($id)
    {

    }

    public function patchPaperAction($id)
    {

    }

    public function deletePaperAction($id)
    {

    }
}