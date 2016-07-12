<?php

namespace SoulDock\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * TaggedEntity
 *
 * @ORM\Table(name="tag_tagged_entity")
 * @ORM\Entity(repositoryClass="SoulDock\TagBundle\Repository\TaggedEntityRepository")
 */
class TaggedEntity
{
    /**
     * Timestampable behavior
     */
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resource_type", type="string", length=255)
     */
    private $resourceType;

    /**
     * @var int
     *
     * @ORM\Column(name="resource_id", type="integer")
     */
    private $resourceId;

    /**
     * @var Tag[]
     *
     * @ORM\ManyToOne(targetEntity="SoulDock\TagBundle\Entity\Tag", inversedBy="entities")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tag;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set resource type
     *
     * @param string $resourceType
     *
     * @return TaggedEntity
     */
    public function setResourceType($resourceType)
    {
        $this->resourceType = $resourceType;

        return $this;
    }

    /**
     * Get resource type
     *
     * @return string
     */
    public function getResourceType()
    {
        return $this->resourceType;
    }

    /**
     * Set recourceId
     *
     * @param integer $resourceId
     *
     * @return TaggedEntity
     */
    public function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;

        return $this;
    }

    /**
     * Get resourceId
     *
     * @return int
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * Set tag
     *
     * @param Tag $tag
     *
     * @return $this
     */
    public function setTag(Tag $tag)
    {
       $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}

