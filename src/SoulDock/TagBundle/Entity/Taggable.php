<?php

namespace SoulDock\TagBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface TaggableInterface
 *
 * @package SoulDock\TagBundle\Entity
 */
interface Taggable
{
    /**
     * Returns the unique taggable resource type
     *
     * @return string
     */
    function getTaggableType();

    /**
     * Returns the unique taggable resource identifier
     *
     * @return string
     */
    function getTaggableId();

    /**
     * Returns the collection of tags for this Taggable entity
     *
     * @return ArrayCollection
     */
    function getTags();

}
