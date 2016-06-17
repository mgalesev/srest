<?php

namespace SoulDock\PaperBundle\Tests\Controller;

use SoulDock\RestBundle\Tests\Controller\BaseTestControllerAuth;

/**
 * Class PaperControllerTest
 *
 * @group web
 * @group rest
 * @group paper
 *
 * @package SoulDock\PaperBundle\Tests\Controller
 */
class PaperControllerTest extends BaseTestControllerAuth
{
    /**
     * { @inheritdoc }
     */
    public function getBaseUrl()
    {
        return '/api/v1/papers';
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
            [null, '[{"id":1,"title":"First Test Paper","body":"First Test Paper Body","type":{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}},{"id":2,"title":"Second Test Paper","body":"Second Test Paper Body","type":{"id":2,"name":"Paper Type Two","description":"Paper Type Two Description"}},{"id":3,"title":"Third Test Paper","body":"Third Test Paper Body","type":{"id":2,"name":"Paper Type Two","description":"Paper Type Two Description"}}]']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function getRequestProvider()
    {
        return [
            [1, null, '{"id":1,"title":"First Test Paper","body":"First Test Paper Body","type":{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function postRequestProvider()
    {
        return [
            ['{"paper":{"title":"Test 1 Paper Title","body":"Test 1 Paper Body","type":1}}', '{"id":4,"title":"Test 1 Paper Title","body":"Test 1 Paper Body","type":{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function putRequestProvider()
    {
        return [
            [3, '{"paper":{"title":"Test 1 Paper Title Updated","body":"Test 1 Paper Body","type":1}}', '{"id":3,"title":"Test 1 Paper Title Updated","body":"Test 1 Paper Body","type":{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function patchRequestProvider()
    {
        return [
            [3, '{"paper":{"title":"Test 1 Paper Title Changed","body":"Test 1 Paper Body","type":1}}', '{"id":3,"title":"Test 1 Paper Title Changed","body":"Test 1 Paper Body","type":{"id":1,"name":"Paper Type One","description":"Paper Type One Description"}}']
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