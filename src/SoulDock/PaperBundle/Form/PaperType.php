<?php

namespace SoulDock\PaperBundle\Form;

use SoulDock\TagBundle\Form\Type\TagAreaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PaperType
 *
 * @package SoulDock\PaperBundle\Form
 */
class PaperType extends AbstractType
{
    /**
     * { @inheritdoc }
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('type')
            ->add('tags', TagAreaType::class)
        ;
    }

    /**
     * { @inheritdoc }
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoulDock\PaperBundle\Entity\Paper',
        ));
    }

    /**
     * { @inheritdoc }
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
