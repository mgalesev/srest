<?php

namespace SoulDock\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use SoulDock\SurveyBundle\Entity\Survey;

/**
 * Class SurveyAdmin
 *
 * @package SoulDock\AdminBundle\Admin
 */
class SurveyAdmin extends AbstractAdmin
{
    /**
     * { @inheritdoc }
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        $formMapper
            ->add('title')
            ->add('public')
        ;

        if ($subject->getId() != null) {
            $formMapper->add('questions', 'sonata_type_collection', [], [
                'edit' => 'inline',
                'inline' => 'table',
            ]);
        }
    }

    /**
     * { @inheritdoc }
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('public')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('title')
            ->add('public')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('public')
            ->add('questions')
        ;
    }

    /**
     * Set question and answer on create.
     *
     * @param Survey $object
     */
    public function prePersist($object)
    {
        foreach ($object->getQuestions() as $question) {
            $question->setSurvey($this->getSubject());

            foreach ($question->getAnswers() as $answer) {
                $answer->setQuestion($question);
            }
        }

        parent::prePersist($object);
    }

    /**
     * Set question and answer on update.
     *
     * @param Survey $object
     */
    public function preUpdate($object)
    {
        foreach ($object->getQuestions() as $question) {
            $question->setSurvey($this->getSubject());

            foreach ($question->getAnswers() as $answer) {
                $answer->setQuestion($question);
            }
        }

        parent::preUpdate($object);
    }
}