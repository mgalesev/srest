<?php

namespace SoulDock\TagBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SoulDock\TagBundle\Service\TagManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

/**
 * Class TagCollectionType
 *
 * @package SoulDock\TagBundle\Form\Type
 */
class TagCollectionType extends AbstractType
{
    /**
     * @var TagManager
     */
    private $tagManager;

    /**
     * @var DataTransformerInterface
     */
    private $tagTransformer;

//    /**
//     * TagAreaType constructor.
//     *
//     * @param TagManager               $tagManager
//     * @param DataTransformerInterface $tagTransformer
//     */
//    public function __construct(TagManager $tagManager, DataTransformerInterface $tagTransformer)
//    {
//        $this->tagManager     = $tagManager;
//        $this->tagTransformer = $tagTransformer;
//    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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