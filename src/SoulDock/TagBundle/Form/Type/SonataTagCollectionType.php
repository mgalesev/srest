<?php

namespace SoulDock\TagBundle\Form\Type;

use Sonata\AdminBundle\Form\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

/**
 * Class SonataTagCollectionType
 *
 * @package SoulDock\TagBundle\Form\Type
 */
class SonataTagCollectionType extends AbstractType
{
    /**
     * @var DataTransformerInterface
     */
    private $tagTransformer;

    /**
     * TagAreaType constructor.
     *
     * @param DataTransformerInterface $tagTransformer
     */
    public function __construct(DataTransformerInterface $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->tagTransformer);

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $parent = $event->getForm()->getParent();
                $data = $parent->getData();
                $data->setUpdatedAt(new \DateTime);
            }
        );
    }

    /**
     * { @inheritdoc }
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entry_type' => TagType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return CollectionType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tag_collection';
    }
}