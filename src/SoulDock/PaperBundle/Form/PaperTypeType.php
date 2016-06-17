<?php

namespace SoulDock\PaperBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaperTypeType extends AbstractType
{
    /**
     * { @inheritdoc }
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
        ;
    }

    /**
     * { @inheritdoc }
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoulDock\PaperBundle\Entity\PaperType',
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
