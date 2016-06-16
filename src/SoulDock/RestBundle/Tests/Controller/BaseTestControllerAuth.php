<?php

namespace SoulDock\RestBundle\Tests\Controller;

/**
 * Class BaseTestControllerAuth
 *
 * @package SoulDock\RestBundle\Tests\Controller
 */
abstract class BaseTestControllerAuth extends BaseTestController
{
    /**
     * Test if list page retruns response 401.
     */
    public function testUnauthorizedList()
    {
        $client = static::createClient();

        $client->request('GET', $this->getBaseUrl());

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if post page retruns response 401.
     */
    public function testUnauthorizedPost()
    {
        $client = static::createClient();

        $client->request('POST', $this->getBaseUrl());

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if get page retruns response 401.
     */
    public function testUnauthorizedGet()
    {
        $client = static::createClient();

        $client->request('GET', $this->getBaseUrl() . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if put page retruns response 401.
     */
    public function testUnauthorizedPut()
    {
        $client = static::createClient();

        $client->request('PUT', $this->getBaseUrl() . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if patch page retruns response 401.
     */
    public function testUnauthorizedPatch()
    {
        $client = static::createClient();

        $client->request('PATCH', $this->getBaseUrl() . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Test if delete page retruns response 401.
     */
    public function testUnauthorizedDelete()
    {
        $client = static::createClient();

        $client->request('DELETE', $this->getBaseUrl() . '/1');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * Get authenticated client
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function getClient()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'xxxx',
        ));

        return $client;
    }
}