<?php
/**
 * Created by PhpStorm.
 * User: milan
 * Date: 6/16/16
 * Time: 10:53 AM
 */

namespace SoulDock\RestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BaseTestController
 *
 * @package SoulDock\RestBundle\Tests\Controller
 */
abstract class BaseTestController extends WebTestCase
{
    /**
     * Retrun base url for resource.
     *
     * @return string
     */
    abstract protected function getBaseUrl();


    /**
     * Get web client to simulate requests.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function getClient()
    {
        $client = self::createClient();

        return $client;
    }

    /**
     * Test POST request.
     *
     * @param string $input  Input data to be send in body of request
     * @param string $output Expected output in response
     * @param string $format Content type (json|xml)
     */
    protected function postRequestTest($input, $output, $format)
    {
        $client = $this->getClient();

        $client->request(
            'POST',
            sprintf('%s.%s', $this->getBaseUrl(), $format),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/'. $format),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals(201, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/' . $format
            )
        );

        $this->assertEquals($output, $response->getContent());
    }

    /**
     * Test PUT request.
     *
     * @param int    $id     Indentifier of entity to update
     * @param string $input  Input data to be send in body of request
     * @param string $output Expected output in response
     * @param string $format Content type (json|xml)
     */
    protected function putRequestTest($id, $input, $output, $format)
    {
        $client = $this->getClient();

        $client->request(
            'PUT',
            sprintf('%s/%s.%s', $this->getBaseUrl(), $id, $format),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/' . $format),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/' . $format
            )
        );

        $this->assertEquals($output, $response->getContent());
    }
}