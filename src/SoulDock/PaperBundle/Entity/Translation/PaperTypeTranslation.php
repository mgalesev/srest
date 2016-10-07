<?php
// src/AppBundle/Entity/FAQCategory/Translation.php

namespace SoulDock\PaperBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="paper_type_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_faq_category_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class PaperTypeTranslation extends AbstractPersonalTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="SoulDock\PaperBundle\Entity\PaperType", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}