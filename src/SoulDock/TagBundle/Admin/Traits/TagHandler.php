<?php

namespace SoulDock\TagBundle\Admin\Traits;

use Symfony\Component\Form\DataTransformerInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Class TagHandler
 *
 * @package SoulDock\TagBundle\Admin\Traits
 */
trait TagHandler
{
    protected static $tagTransformer;

    public static function setTagTransformer(DataTransformerInterface $tagTransformer)
    {
        self::$tagTransformer = $tagTransformer;
    }

    public function getFormBuilder()
    {
        $formBuilder = parent::getFormBuilder();
        $formBuilder->addModelTransformer(self::$tagTransformer);

        return $formBuilder;
    }

    public function listTags(ListMapper $listMapper)
    {
        $listMapper->add('tags', 'tags', [
            'template' => 'SoulDockAdminBundle:CRUD:list_tags.html.twig',
        ]);
    }
}