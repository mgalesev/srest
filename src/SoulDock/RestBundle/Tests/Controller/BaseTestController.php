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
    abstract public function getBaseUrl();


    /**
     * Get format of data used in requests.(json|xml|...)
     *
     * @return string
     */
    abstract public function getFormat();

    /**
     * Data provider for testGetAllRequest
     *
     * @return array
     */
    abstract public function getAllRequestProvider();

    /**
     * Data provider for testGetRequest
     *
     * @return array
     */
    abstract public function getRequestProvider();

    /**
     * Data provider for testPostRequest
     *
     * @return array
     */
    abstract public function postRequestProvider();

    /**
     * Data provider for testPutRequest
     *
     * @return array
     */
    abstract public function putRequestProvider();

    /**
     * Data provider for testPatchRequest
     *
     * @return array
     */
    abstract public function patchRequestProvider();

    /**
     * Data provider for testDeleteRequest
     *
     * @return array
     */
    abstract public function deleteRequestProvider();

    /**
     * Test GET all Request
     *
     * @param string $input      Data to be passed in body of request.
     * @param string $output     Expected response body of post action.
     * @param int    $statusCode Expected status code of response.
     *
     * @dataProvider getAllRequestProvider
     */
    public function testGetAllRequest($input, $output, $statusCode=200)
    {
        $client = $this->getClient();

        $client->request(
            'GET',
            sprintf('%s.%s', $this->getBaseUrl(), $this->getFormat()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/'. $this->getFormat()),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/' . $this->getFormat()
            )
        );

        $this->assertEquals($output, $response->getContent());
    }

    /**
     * Test GET all Request
     *
     * @param int    $id         Entity identifier.
     * @param string $input      Data to be passed in body of request.
     * @param string $output     Expected response body of post action.
     * @param int    $statusCode Expected status code of response.
     *
     * @dataProvider getRequestProvider
     */
    public function testGetRequest($id, $input, $output, $statusCode=200)
    {
        $client = $this->getClient();

        $client->request(
            'GET',
            sprintf('%s/%s.%s', $this->getBaseUrl(), $id, $this->getFormat()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/'. $this->getFormat()),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/' . $this->getFormat()
            )
        );

        $this->assertEquals($output, $response->getContent());
    }

    /**
     * Test POST Request
     *
     * @param string $input      Data to be passed in body of request.
     * @param string $output     Expected response body of post action.
     * @param int    $statusCode Expected status code of response.
     *
     * @dataProvider postRequestProvider
     */
    public function testPostRequest($input, $output, $statusCode=201)
    {
        $client = $this->getClient();

        $client->request(
            'POST',
            sprintf('%s.%s', $this->getBaseUrl(), $this->getFormat()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/'. $this->getFormat()),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/' . $this->getFormat()
            )
        );

        $this->assertEquals($output, $response->getContent());
    }

    /**
     * Test PUT Request.
     *
     * @param int    $id         Indentifier of entity to update
     * @param string $input      Input data to be send in body of request
     * @param string $output     Expected output in response
     * @param int    $statusCode Expected status code of response.
     *
     * @dataProvider putRequestProvider
     */
    public function testPutRequest($id, $input, $output, $statusCode=200)
    {
        $client = $this->getClient();

        $client->request(
            'PUT',
            sprintf('%s/%s.%s', $this->getBaseUrl(), $id, $this->getFormat()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/' . $this->getFormat()),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/' . $this->getFormat()
            )
        );

        $this->assertEquals($output, $response->getContent());
    }

    /**
     * Test PATCH request.
     *
     * @param int    $id         Indentifier of entity to update
     * @param string $input      Input data to be send in body of request
     * @param string $output     Expected output in response
     * @param int    $statusCode Expected status code of response.
     *
     * @dataProvider patchRequestProvider
     */
    public function testPatchRequest($id, $input, $output, $statusCode=200)
    {
        $client = $this->getClient();

        $client->request(
            'PATCH',
            sprintf('%s/%s.%s', $this->getBaseUrl(), $id, $this->getFormat()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/' . $this->getFormat()),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/' . $this->getFormat()
            )
        );

        $this->assertEquals($output, $response->getContent());
    }

    /**
     * Test DELETE request.
     *
     * @param int    $id         Indentifier of entity to delete
     * @param string $input      Input data to be send in body of request
     * @param string $output     Expected output in response
     * @param int    $statusCode Expected status code of response.
     *
     * @dataProvider deleteRequestProvider
     */
    public function testDeleteRequest($id, $input, $output, $statusCode=204)
    {
        $client = $this->getClient();

        $client->request(
            'DELETE',
            sprintf('%s/%s.%s', $this->getBaseUrl(), $id, $this->getFormat()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/' . $this->getFormat()),
            $input
        );

        $response = $client->getResponse();

        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode());

        $this->assertEquals($output, $response->getContent());
    }

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
}