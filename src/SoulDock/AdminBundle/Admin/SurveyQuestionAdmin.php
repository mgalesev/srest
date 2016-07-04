<?php

namespace SoulDock\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

/**
 * Class SurveyQuestionAdmin
 *
 * @package SoulDock\AdminBundle\Admin
 */
class SurveyQuestionAdmin extends AbstractAdmin
{
    /**
     * { @inheritdoc }
     */
    protected $parentAssociationMapping = 'survey';

    /**
     * { @inheritdoc }
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        if ($this->getRoot()->getClass() != 'SoulDock\SurveyBundle\Entity\Survey') {
            $formMapper->add('survey');
        }

        $formMapper
            ->add('question')
            ->add('weight')
        ;

        if ($subject->getId() != null) {
            $formMapper->add('answers', 'sonata_type_collection', [], [
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
            ->add('question')
            ->add('survey')
            ->add('weight')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('survey')
            ->add('question')
            ->add('weight')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('question')
            ->add('weight')
            ->add('answers')
        ;
    }

    /**
     * { @inheritdoc }
     */
    public function prePersist($object)
    {
        foreach ($object->getAnswers() as $answer) {
            $answer->setQuestion($this->getSubject());
        }

        parent::prePersist($object);
    }

    /**
     * { @inheritdoc }
     */
    public function preUpdate($object)
    {
        foreach ($object->getAnswers() as $answer) {
            $answer->setQuestion($this->getSubject());
        }

        parent::preUpdate($object);
    }
}