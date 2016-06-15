<?php

namespace SoulDock\RestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BaseTestControllerAuth
 *
 * @package SoulDock\RestBundle\Tests\Controller
 */
class BaseTestControllerAuth extends WebTestCase
{
    /**
     * Base url for resource.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Test if list page retruns response 401.
     */
    public function testUnauthorizedList()
    {
        $client = static::createClient();

        $client->request('GET', $this->baseUrl);

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if post page retruns response 401.
     */
    public function testUnauthorizedPost()
    {
        $client = static::createClient();

        $client->request('POST', $this->baseUrl);

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if get page retruns response 401.
     */
    public function testUnauthorizedGet()
    {
        $client = static::createClient();

        $client->request('GET', $this->baseUrl . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if put page retruns response 401.
     */
    public function testUnauthorizedPut()
    {
        $client = static::createClient();

        $client->request('PUT', $this->baseUrl . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if patch page retruns response 401.
     */
    public function testUnauthorizedPatch()
    {
        $client = static::createClient();

        $client->request('PATCH', $this->baseUrl . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if delete page retruns response 401.
     */
    public function testUnauthorizedDelete()
    {
        $client = static::createClient();

        $client->request('DELETE', $this->baseUrl . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }
}