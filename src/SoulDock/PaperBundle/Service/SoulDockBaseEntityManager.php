<?php

namespace SoulDock\PaperBundle\Service;


use Doctrine\ORM\EntityManager;

/**
 * Class SoulDockBaseEntityManager
 *
 * @package SoulDock\PaperBundle\Service
 */
class SoulDockBaseEntityManager implements SoulDockEntityManagerInterface
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * Name of the class.
     *
     * @var string
     */
    protected $class;

    /**
     * SoulDockBaseEntityManager constructor.
     *
     * @param EntityManager $entityManager Doctrine entity manager
     * @param string        $class         Class name
     */
    public function __construct(EntityManager $entityManager, $class)
    {
        $this->em = $entityManager;
        $this->class = $class;
    }

    /**
     * Create new entity.
     *
     * @return object
     */
    public function createNew()
    {
        $class = $this->em
            ->getRepository($this->class)
            ->getClassName();

        return new $class;
    }

    /**
     * Find entity by id.
     *
     * @param int $id Entity identifier
     *
     * @return null|object
     */
    public function find($id)
    {
        return $this->em
            ->getRepository($this->class)
            ->find($id);
    }

    /**
     * Search entites by given criterias.
     *
     * @param array $filter List of fiels=>value pairs to filter by
     * @param array $order  List of field=>directions pairs to sort by
     * @param int   $limit  Number of entities to return
     * @param int   $offset Number of entity to start from
     *
     * @return mixed
     */
    public function findAll($filter, $order, $limit, $offset)
    {
        return $this->em
            ->getRepository($this->class)
                ->findBy(
                    $filter,
                    $order,
                    $limit,
                    $offset
                );
    }

    /**
     * Search entites by given criterias.
     *
     * @param array $filter
     *
     * @return mixed
     */
    public function count($filter)
    {
        $qb = $this->em
            ->getRepository($this->class)
            ->createQueryBuilder('c');

        $qb->select('count(c.id)');

        foreach ($filter as $key=>$value) {
            if (is_array($value)) {
                $qb->andWhere('c.' . $key . 'IN (:' . $key . ')');
            }
            else {
                $qb->andWhere('c.' . $key . '=:' . $key);
            }

            $qb->setParameter($key, $value);
        }

        return $qb->getQuery()->getSingleScalarResult();

    }

    /**
     * Save entity.
     *
     * @param object $entity Entity to save
     *
     * @return object
     */
    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * Delete entity.
     *
     * @param object $entity Entity to delete
     */
    public function delete($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }
}