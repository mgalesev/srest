<?php

namespace SoulDock\RestBundle\Tests\Controller;

/**
 * Class BaseTestControllerAuthJson
 *
 * @package SoulDock\RestBundle\Tests\Controller
 */
abstract class BaseTestControllerAuthJson extends BaseTestControllerAuth
{
    /**
     * Test POST json Request
     *
     * @param string $input  Json string to be passed in body of request.
     * @param string $output Expected response body of post action.
     *
     * @dataProvider postJsonRequestProvider
     */
    public function testPostJsonRequest($input, $output)
    {
        $this->postRequestTest($input, $output, 'json');
    }

    /**
     * Test PUT json Request
     *
     * @param int    $id     Identifier of entity we want to update
     * @param string $input  Json string to be passed in body of request.
     * @param string $output Expected response body of put action.
     *
     * @dataProvider putJsonRequestProvider
     */
    public function testPutJsonRequest($id, $input, $output)
    {
        $this->putRequestTest($id, $input, $output, 'json');
    }

    /**
     * Data provider for testPostJsonRequest
     *
     * @return array
     */
    abstract function postJsonRequestProvider();

    /**
     * Data provider for testPutJsonRequest
     *
     * @return array
     */
    abstract function putJsonRequestProvider();
}