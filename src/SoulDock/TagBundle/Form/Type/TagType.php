<?php

namespace SoulDock\TagBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagType
 *
 * @package SoulDock\TagBundle\Form\Type
 */
class TagType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $parent = $this->getParent();

        if ($parent) {
            $data = true;
            if ($data) {
                $builder->add('name', null, [
                    'label' => false,
                    'attr' => [
//                        'disabled' => 'disabled',
                    ]
                ]);
            }
            else {
                $builder->add('name', null, [
                    'label' => false,
                ]);
            }
        }
        else {
            $builder->add('name');
        }
    }

    /**
     * { @inheritdoc }
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoulDock\TagBundle\Entity\Tag',
        ));
    }
}