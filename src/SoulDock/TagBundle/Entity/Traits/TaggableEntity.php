<?php

namespace SoulDock\TagBundle\Entity\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use SoulDock\TagBundle\Entity\Tag;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Accessor;

/**
 * Class TaggableEntity
 *
 * @package SoulDock\TagBundle\Entity\Traits
 */
trait TaggableEntity
{
    /**
     * @var Tag[]|ArrayCollection
     *
     * @Expose
     * @Accessor(getter="getTagNames",setter="setTagNames")
     */
    public $tags;

    /**
     * Get tags
     *
     * @return Tag[]|ArrayCollection
     */
    public function getTags()
    {
        $this->tags = $this->tags ? : new ArrayCollection();

        return $this->tags;
    }

    /**
     * Add tag
     *
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag($tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    /**
     * Remove tag
     *
     * @param Tag $tag
     */
    public function removeTag($tag)
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }
    }

    /**
     * Get type for given entity
     *
     * @return string
     */
    public function getTaggableType()
    {
        return strtolower(substr(strrchr(get_class($this), '\\'), 1));
    }

    /**
     * Get entity id.
     *
     * @return int
     */
    public function getTaggableId()
    {
        return $this->getId();
    }

    /**
     * Get tag names
     *
     * @return array
     */
    public function getTagNames()
    {
        $tagNames = array();

        foreach ($this->getTags() as $tag) {
            $tagNames[] = $tag->getName();
        }

        return $tagNames;
    }

    /**
     * Set tag names
     *
     * @param $tagNames
     */
    public function setTagNames($tagNames)
    {
        $this->tags_plain = $tagNames;
    }

}