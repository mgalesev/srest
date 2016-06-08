<?php
/**
 * Created by PhpStorm.
 * User: milan
 * Date: 6/8/16
 * Time: 9:22 AM
 */

namespace AppBundle\Service;

use AppBundle\Entity\Paper;
use Doctrine\ORM\EntityManager;

class PaperManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * PaperManager constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $id
     *
     * @return Paper
     */
    public function find($id)
    {
        return $this->em
            ->getRepository('AppBundle:Paper')
            ->find($id);
    }
}