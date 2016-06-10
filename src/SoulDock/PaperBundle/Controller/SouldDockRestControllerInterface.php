<?php
/**
 * Created by PhpStorm.
 * User: milan
 * Date: 6/10/16
 * Time: 1:38 PM
 */

namespace SoulDock\PaperBundle\Controller;

use SoulDock\PaperBundle\Service\SoulDockEntityManagerInterface;


interface SouldDockRestControllerInterface
{

    /**
     * Return entity manager to be user for processing entities.
     *
     * @return SoulDockEntityManagerInterface
     */
    public function getManager();

    /**
     * Handle form submition, validation and entity managment.
     *
     * @param string $formClass Form class name
     * @param object $object    Object
     * @param string $method    HTTP Method (POST|PUT|PATCH)
     *
     * @return mixed
     */
    public function handleForm($formClass, $object, $method);
}