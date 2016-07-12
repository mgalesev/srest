<?php

namespace SoulDock\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use SoulDock\TagBundle\Form\Type\SonataTagCollectionType;
use SoulDock\TagBundle\Form\Type\TagAreaType;

/**
 * Class PaperAdmin
 *
 * @package SoulDock\AdminBundle\Admin
 */
class PaperAdmin extends AbstractAdmin
{
    /**
     * { @inheritdoc }
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('body')
            ->add('type')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('body')
            ->add('type')
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
            ->add('body')
            ->add('type')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('body')
            ->add('type')
        ;
    }
}