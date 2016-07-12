<?php

namespace SoulDock\TagBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SoulDock\TagBundle\Service\TagManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Class TagAreaType
 *
 * @package SoulDock\TagBundle\Form\Type
 */
class TagAreaType extends AbstractType
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
        $resolver->setDefaults(array(
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextareaType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tag_area';
    }
}