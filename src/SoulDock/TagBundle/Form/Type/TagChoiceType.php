<?php

namespace SoulDock\TagBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class TagChoiceType
 *
 * @package SoulDock\TagBundle\Form\Type
 */
class TagChoiceType extends AbstractType
{
    private $tagManager;

    public function __construct($tagManager)
    {
        $this->tagManager = $tagManager;
    }

    /**
     * { @inheritdoc }
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'm' => 'Male',
                'f' => 'Female',
            )
        ));
    }

    /**
     * { @inheritdoc }
     */
    public function getParent()
    {
        return ChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tag_choice';
    }
}