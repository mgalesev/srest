<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;

class PaperController extends FOSRestController
{

    public function getPaperAction($id)
    {
        return $this->get('paper.manager')->find($id);
    }
}