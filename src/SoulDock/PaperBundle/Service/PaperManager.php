<?php
/**
 * Created by PhpStorm.
 * User: milan
 * Date: 6/8/16
 * Time: 9:22 AM
 */

namespace SoulDock\PaperBundle\Service;

use SoulDock\PaperBundle\Entity\Paper;
use Doctrine\ORM\EntityManager;
use SoulDock\PaperBundle\Entity\PaperType;

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
    public function findPaper($id)
    {
        return $this->em
            ->getRepository('SoulDockPaperBundle:Paper')
            ->find($id);
    }

    /**
     *
     * @return Paper[]
     */
    public function findAllPapers()
    {
        return $this->em
            ->getRepository('SoulDockPaperBundle:Paper')
            ->findAll();
    }

    /**
     * @param $id
     *
     * @return PaperType
     */
    public function findPaperType($id)
    {
        return $this->em
            ->getRepository('SoulDockPaperBundle:PaperType')
            ->find($id);
    }

    /**
     *
     * @return PaperType[]
     */
    public function findAllPaperTypes($limit, $offset)
    {
        return $this->em
            ->getRepository('SoulDockPaperBundle:PaperType')
            ->findBy(array(), array(), $limit, $offset);
    }

    /**
     * @return PaperType
     */
    public function createPaperType()
    {
        $paperType = new PaperType();

        return $paperType;
    }

    /**
     * @param object $paperType
     *
     * @return object
     */
    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}