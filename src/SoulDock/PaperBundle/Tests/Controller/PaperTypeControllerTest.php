<?php

namespace SoulDock\PaperBundle\Tests\Controller;

use SoulDock\RestBundle\Tests\Controller\BaseTestControllerAuthJson;

/**
 * Class PaperTypeControllerTest
 *
 * @package SoulDock\PaperBundle\Tests\Controller
 */
class PaperTypeControllerTest extends BaseTestControllerAuthJson
{
    /**
     * { @inheritdoc }
     */
    protected function getBaseUrl()
    {
        return '/api/v1/papertypes';
    }

    /**
     * { @inheritdoc }
     */
    public function postJsonRequestProvider()
    {
        return [
            ['{"paper_type":{"name":"First Paper Type", "description":"First Paper Type description"}}', '{"id":2,"name":"First Paper Type","description":"First Paper Type description"}']
        ];
    }

    /**
     * { @inheritdoc }
     */
    public function putJsonRequestProvider()
    {
        return [
            [2, '{"paper_type":{"name":"First Paper Type Updated", "description":"First Paper Type description"}}', '{"id":2,"name":"First Paper Type Updated","description":"First Paper Type description"}']
        ];
    }
}
