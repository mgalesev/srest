<?php

namespace SoulDock\TagBundle\Form\Type;

use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class TagAutocompleteType
 *
 * @package SoulDock\TagBundle\Form\Type
 */
class TagAutocompleteType extends AbstractType
{
    private $tagManager;
    private $modelManager;

    public function __construct($tagManager, $modelManager)
    {
        $this->tagManager = $tagManager;
        $this->modelManager = $modelManager;
    }

    /**
     * { @inheritdoc }
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'property' => 'name',
            'model_manager' => $this->modelManager,
            'class' => 'SoulDock\TagBundle\Entity\Tag',
            'multiple' => true,
        ));
    }

    /**
     * { @inheritdoc }
     */
    public function getParent()
    {
        return ModelAutocompleteType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tag_autocomplete';
    }
}