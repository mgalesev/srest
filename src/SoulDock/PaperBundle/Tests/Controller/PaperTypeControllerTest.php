<?php

namespace SoulDock\PaperBundle\Tests\Controller;

use SoulDock\RestBundle\Tests\Controller\BaseTestControllerAuth;

/**
 * Class PaperTypeControllerTest
 *
 * @group web
 * @group rest
 * @group paper
 *
 * @package SoulDock\PaperBundle\Tests\Controller
 */
class PaperTypeControllerTest extends BaseTestControllerAuth
{
    /**
     * { @inheritdoc }
     */
    public function getBaseUrl()
    {
        return '/api/v1/papertypes';
    }

    /**
     * { @inheritdoc }
     */
    public function getFormat()
    {
        return 'json';
    }

    /**
     * { @inheritdoc }
     */
    public function getAllRequestProvider()
    {
        return [
            [null, '[{"id":1,"name":"Paper Type One","description":"Paper Type One Description"},{"id":2,"name":"Paper Type Two","description":"Paper Type Two Description"},{"id":3,"name":"Paper Type Three","description":"Paper Type Three Description"}]']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function getRequestProvider()
    {
        return [
            [1, null, '{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function postRequestProvider()
    {
        return [
            ['{"name":"Forth Paper Type", "description":"Forth Paper Type description"}', '{"id":4,"name":"Forth Paper Type","description":"Forth Paper Type description"}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function putRequestProvider()
    {
        return [
            [3, '{"name":"Forth Paper Type Updated", "description":"Forth Paper Type description"}', '{"id":3,"name":"Forth Paper Type Updated","description":"Forth Paper Type description"}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function patchRequestProvider()
    {
        return [
            [3, '{"name":"Forth Paper Type Changed", "description":"Forth Paper Type description"}', '{"id":3,"name":"Forth Paper Type Changed","description":"Forth Paper Type description"}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function deleteRequestProvider()
    {
        return [
            [3, '', '']
        ];
    }
}
