<?php

namespace SoulDock\PaperBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Sonata\TranslationBundle\Traits\Gedmo\PersonalTranslatableTrait;

/**
 * PaperType
 *
 * @ORM\Table(name="paper_type")
 * @ORM\Entity(repositoryClass="SoulDock\PaperBundle\Repository\PaperTypeRepository")
 * @Gedmo\TranslationEntity(class="SoulDock\PaperBundle\Entity\Translation\PaperTypeTranslation")
 *
 * @UniqueEntity("name")
 *
 * @ExclusionPolicy("all")
 */
class PaperType implements TranslatableInterface
{
    /**
     * Timestabpable trait
     */
    use TimestampableEntity;

    use PersonalTranslatableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     *
     * @Expose
     */
    private $name;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     * @Expose
     */
    private $description;

    /**
     * @var Paper[]
     *
     * @ORM\OneToMany(targetEntity="SoulDock\PaperBundle\Entity\Paper", mappedBy="type")
     */
    private $papers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="SoulDock\PaperBundle\Entity\Translation\PaperTypeTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    /**
     * PaperType constructor.
     */
    public function __construct()
    {
        $this->papers = new ArrayCollection();
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
     * @return PaperType
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
     * Set description
     *
     * @param string $description
     *
     * @return PaperType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get papers
     *
     * @return Paper[]
     */
    public function getPapers()
    {
        return $this->papers;
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

