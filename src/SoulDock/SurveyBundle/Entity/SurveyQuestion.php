<?php

namespace SoulDock\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * SurveyQuestion
 *
 * @ORM\Table(name="survey_question")
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class SurveyQuestion
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
     * @ORM\Column(name="question", type="text", nullable=false)
     */
    private $question;

    /**
     * @var Survey
     *
     * @ORM\ManyToOne(targetEntity="SoulDock\SurveyBundle\Entity\Survey", inversedBy="questions")
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $survey;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var SurveyAnswer[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SoulDock\SurveyBundle\Entity\SurveyAnswer", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="question")
     */
    private $answers;

    /**
     * SurveyQuestion constructor.
     */
    public function __construct()
    {
        $this->weight = 0;
        $this->answers = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param $question
     *
     * @return $this
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set survey
     *
     * @param Survey $survey
     *
     * @return $this
     */
    public function setSurvey($survey)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey
     *
     * @return Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set weight
     *
     * @param int $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Set answers
     *
     * @param SurveyAnswer[] $answers
     *
     * @return $this
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Get answers
     *
     * @return SurveyAnswer[]|ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add answer
     *
     * @param SurveyAnswer $answer
     *
     * @return $this
     */
    public function addAnswer(SurveyAnswer $answer)
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    /**
     * Remove question
     *
     * @param SurveyAnswer $answer
     *
     * @return $this
     */
    public function removeAnswer(SurveyAnswer $answer)
    {
        if ($this->answers->contains($answer)) {
            $this->answers->remove($answer);
            $answer->setQuestion(null);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->question;
    }
}
