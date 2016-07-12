<?php

namespace SoulDock\TagBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use SoulDock\TagBundle\Service\TagManager;

/**
 * Class CollectionToTagTransformer
 *
 * @package SoulDock\TagBundle\Form\DataTransformer
 */
class CollectionToTagTransformer implements DataTransformerInterface
{
    /**
     * @var TagManager
     */
    private $tagManager;

    /**
     * TextToTagTransformer constructor.
     *
     * @param TagManager $tagManager
     */
    public function __construct(TagManager $tagManager)
    {
        $this->tagManager = $tagManager;
    }

    /**
     * { @inheritdoc }
     */
    public function transform($object)
    {
        return $object;
    }

    /**
     * { @inheritdoc }
     */
    public function reverseTransform($collection)
    {
        $tags = new ArrayCollection();

        foreach ($collection as $item) {
            $tag = $this->tagManager->loadOrCreateTag($item->getName());
            $tags->add($tag);
        }

        return $tags;
    }
}