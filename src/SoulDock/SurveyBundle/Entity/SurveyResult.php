<?php

namespace SoulDock\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * SurveyResult
 *
 * @ORM\Table(name="survey_result")
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class SurveyResult
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
     * @var  UserInterface|null
     *
     * @ORM\ManyToOne(targetEntity="\SoulDock\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $author;

    /**
     * @var Survey
     *
     * @ORM\ManyToOne(targetEntity="SoulDock\SurveyBundle\Entity\Survey", inversedBy="results")
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $survey;

    /**
     * @var SurveyQuestion
     *
     * @ORM\ManyToOne(targetEntity="SoulDock\SurveyBundle\Entity\SurveyQuestion")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $question;

    /**
     * @var SurveyAnswer
     *
     * @ORM\ManyToOne(targetEntity="SoulDock\SurveyBundle\Entity\SurveyAnswer")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     */
    private $answer;

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
     * Set author
     *
     * @param UserInterface|null $author
     *
     * @return $this
     */
    public function setAuthor(UserInterface $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return UserInterface|null
     */
    public function getAuthor()
    {
        return $this->author;
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

    /**
     * Set answer
     *
     * @param SurveyAnswer $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * Get answer
     *
     * @return SurveyAnswer
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
