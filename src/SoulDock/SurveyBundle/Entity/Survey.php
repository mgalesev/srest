<?php

namespace SoulDock\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Survey
 *
 * @ORM\Table(name="survey_survey")
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class Survey
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
     *
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     *
     * @Expose
     */
    private $alias;

    /**
     * @var SurveyQuestion[]
     *
     * @ORM\OneToMany(targetEntity="SoulDock\SurveyBundle\Entity\SurveyQuestion", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="survey")
     * @ORM\OrderBy({"weight" = "ASC"})
     */
    private $questions;

    /**
     * @var bool
     *
     * @ORM\Column(name="public", type="boolean")
     */
    private $public = false;


    /**
     * @var bool
     *
     * @ORM\Column(name="editable", type="boolean")
     */
    private $editAllowed = true;

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="\SoulDock\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $owner;

    /**
     * @var bool
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked = false;


    /**
     * @var SurveyResult[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SoulDock\SurveyBundle\Entity\SurveyResult", mappedBy="survey")
     */
    private $results;

    /**
     * Survey constructor.
     */
    public function __construct()
    {
        $this->alias     = substr(sha1(uniqid()), 0, 6);
        $this->questions = new ArrayCollection();
        $this->results   = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return ArrayCollection|SurveyResult[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @param boolean $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    /**
     * @return boolean True if survey answer can be modified by the author. If false, new answer is send instead
     *                 Edit is not allowed for public surveys
     */
    public function isEditAllowed()
    {
        return $this->isPublic() ? false : $this->editAllowed;
    }

    /**
     * @param boolean $editAllowed
     */
    public function setEditAllowed($editAllowed)
    {
        $this->editAllowed = $editAllowed;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param boolean $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    /**
     * @return UserInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param UserInterface $owner
     */
    public function setOwner(UserInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param null|string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return ArrayCollection|SurveyQuestion[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Add question
     *
     * @param SurveyQuestion $question
     *
     * @return $this
     */
    public function addQuestion(SurveyQuestion $question)
    {
        if (!$this->questions->contains($question)) {
            $question->setSurvey($this);
            $this->questions->add($question);
        }

        return $this;
    }

    /**
     * Remove question
     *
     * @param SurveyQuestion $question
     *
     * @return $this
     */
    public function removeQuestion(SurveyQuestion $question)
    {
        if ($this->questions->contains($question)) {
            $this->questions->remove($question);
            $question->setSurvey(null);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}
