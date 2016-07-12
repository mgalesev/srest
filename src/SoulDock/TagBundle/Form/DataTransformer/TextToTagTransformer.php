<?php

namespace SoulDock\TagBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use SoulDock\TagBundle\Service\TagManager;

/**
 * Class TextToTagTransformer
 *
 * @package SoulDock\TagBundle\Form\DataTransformer
 */
class TextToTagTransformer implements DataTransformerInterface
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

        if (null === $object) {
            return $object;
        }

        $textTags = implode(', ', $object->toArray());

        return $textTags;
    }

    /**
     * { @inheritdoc }
     */
    public function reverseTransform($tagsList)
    {
        $tag_list = array_unique(preg_split('/ *[,\n\r] */', $tagsList, NULL, PREG_SPLIT_NO_EMPTY));

        $tags = new ArrayCollection();
        foreach ($tag_list as $value) {
            $tag = $this->tagManager->loadOrCreateTag($value);
            if (!$tags->contains($tag)) {
                $tags->add($tag);
            }
        }

        return $tags;
    }
}