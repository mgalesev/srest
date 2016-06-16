<?php

namespace SoulDock\PaperBundle\Service;

/**
 * Interface SoulDockEntityManagerInterface
 *
 * @package SoulDock\PaperBundle\Service
 */
interface SoulDockEntityManagerInterface
{

    /**
     * Create new entity.
     *
     * @return mixed
     */
    public function createNew();

    /**
     * Find entity by id.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Search entites by given criterias.
     *
     * @param array $filter
     * @param array $order
     * @param int   $limit
     * @param int   $offset
     *
     * @return mixed
     */
    public function findAll($filter, $order, $limit, $offset);

    /**
     * Search entites by given criterias.
     *
     * @param array $filter
     *
     * @return mixed
     */
    public function count($filter);

    /**
     * Save entity.
     *
     * @param object $entity
     *
     * @return mixed
     */
    public function save($entity);

    /**
     * Delete entity.
     *
     * @param object $entity
     */
    public function delete($entity);
}