<?php

namespace SoulDock\PaperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Sonata\TranslationBundle\Traits\Gedmo\PersonalTranslatableTrait;

/**
 * Paper
 *
 * @ORM\Table(name="paper")
 * @ORM\Entity(repositoryClass="SoulDock\PaperBundle\Repository\PaperRepository")
 * @Gedmo\TranslationEntity(class="SoulDock\PaperBundle\Entity\Translation\PaperTranslation")
 *
 * @ExclusionPolicy("all")
 */
class Paper implements TranslatableInterface
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
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="body", type="text", nullable=true)
     *
     * @Expose
     */
    private $body;

    /**
     * @var PaperType
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="SoulDock\PaperBundle\Entity\PaperType", inversedBy="papers")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @Expose
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="SoulDock\PaperBundle\Entity\Translation\PaperTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

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
     * Set title
     *
     * @param string $title
     *
     * @return Paper
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Paper
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Paper
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return PaperType
     */
    public function getType()
    {
        return $this->type;
    }
}

