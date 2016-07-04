<?php

namespace SoulDock\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SurveyAnswer
 *
 * @ORM\Table(name="survey_answer")
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class SurveyAnswer
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
     * @ORM\Column(name="answer", type="text", nullable=false)
     */
    private $answer;

    /**
     * @var SurveyQuestion
     *
     * @ORM\ManyToOne(targetEntity="SoulDock\SurveyBundle\Entity\SurveyQuestion", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $question;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

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
     * Set answer
     *
     * @param string $answer
     *
     * @return $this
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set question
     *
     * @param SurveyQuestion $question
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
     * @return SurveyQuestion
     */
    public function getQuestion()
    {
        return $this->question;
    }

    public function __toString()
    {
        return $this->answer;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
