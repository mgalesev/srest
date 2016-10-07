<?php
/**
 * Created by PhpStorm.
 * User: milan
 * Date: 6/8/16
 * Time: 9:22 AM
 */

namespace SoulDock\PaperBundle\Service;

use SoulDock\PaperBundle\Entity\Paper;
use SoulDock\PaperBundle\Entity\PaperType;

class PaperManager extends SoulDockBaseEntityManager
{
    public function findPaperTranslation($id, $language)
    {
        $paper = $this->em
            ->getRepository('SoulDockPaperBundle:Paper')
            ->findTranslated($id, $language);

        if ($paper) {
            $this->em
                ->getRepository('SoulDockPaperBundle:PaperType')
                ->findTranslated($paper->getType()->getId(), $language);
        }

        return $paper;
    }

    /**
     *
     * @return Paper[]
     */
    public function findAllPapers()
    {
        return $this->em
            ->getRepository('SoulDockPaperBundle:Paper')
            ->findAll();
    }

    /**
     * @param $id
     *
     * @return PaperType
     */
    public function findPaperType($id)
    {
        return $this->em
            ->getRepository('SoulDockPaperBundle:PaperType')
            ->find($id);
    }

    /**
     *
     * @return PaperType[]
     */
    public function findAllPaperTypes($limit, $offset)
    {
        return $this->em
            ->getRepository('SoulDockPaperBundle:PaperType')
            ->findBy(array(), array(), $limit, $offset);
    }

    /**
     * @return PaperType
     */
    public function createPaperType()
    {
        $paperType = new PaperType();

        return $paperType;
    }

}