<?php

namespace SoulDock\TagBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Tag
 *
 * @ORM\Table(name="tag_tag")
 * @ORM\Entity(repositoryClass="SoulDock\TagBundle\Repository\TagRepository")
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var TaggedEntity[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SoulDock\TagBundle\Entity\TaggedEntity", mappedBy="tag")
     */
    private $entities;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->entities = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get entities
     *
     * @return ArrayCollection|TaggedEntity[]
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}

