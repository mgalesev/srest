<?php

namespace SoulDock\PaperBundle\Tests\Controller;

use SoulDock\RestBundle\Tests\Controller\BaseTestControllerAuthJson;

/**
 * Class PaperControllerTest
 *
 * @package SoulDock\PaperBundle\Tests\Controller
 */
class PaperControllerTest extends BaseTestControllerAuthJson
{
    /**
     * { @inheritdoc }
     */
    protected function getBaseUrl()
    {
        return '/api/v1/papers';
    }

    /**
     * { @inheritdoc }
     */
    public function postJsonRequestProvider()
    {
        return [
            ['{"paper":{"title":"Test 1 Paper Title","body":"Test 1 Paper Body","type":1}}', '{"id":2,"title":"Test 1 Paper Title","body":"Test 1 Paper Body","type":{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function putJsonRequestProvider()
    {
        return [
            [2, '{"paper":{"title":"Test 1 Paper Title Updated","body":"Test 1 Paper Body","type":1}}', '{"id":2,"title":"Test 1 Paper Title Updated","body":"Test 1 Paper Body","type":{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}}']
        ];
    }
}