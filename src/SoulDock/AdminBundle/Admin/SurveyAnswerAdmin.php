<?php

namespace SoulDock\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

/**
 * Class SurveyAnswerAdmin
 *
 * @package SoulDock\AdminBundle\Admin
 */
class SurveyAnswerAdmin extends AbstractAdmin
{
    /**
     * { @inheritdoc }
     */
    protected $parentAssociationMapping = 'question';

    /**
     * { @inheritdoc }
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if (!in_array($this->getRoot()->getClass(), array('SoulDock\SurveyBundle\Entity\SurveyQuestion','SoulDock\SurveyBundle\Entity\Survey'))) {
            $formMapper
                ->add('question');
        }

        $formMapper
            ->add('answer')
            ->add('position')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('question')
            ->add('answer')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('question')
            ->add('answer')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('question')
            ->add('answer')
        ;
    }
}