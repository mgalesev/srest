<?php

namespace SoulDock\TagBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use SoulDock\TagBundle\Service\TagManager;
use SoulDock\TagBundle\Entity\Taggable;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TagListener
 *
 * @package SoulDock\TagBundle\EventListener
 */
class TagListener implements EventSubscriber
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Constructor
     *
     * @param ContainerInterface $serviceContainer
     */
    public function __construct($serviceContainer)
    {
        $this->container = $serviceContainer;
    }

    /**
     * @see Doctrine\Common\EventSubscriber
     */
    public function getSubscribedEvents()
    {
        return [
            Events::preRemove,
            Events::postLoad,
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        if (($resource = $args->getEntity()) and $resource instanceof Taggable) {
            $this->getTagManager()->loadTagging($resource);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        if (($resource = $args->getEntity()) and $resource instanceof Taggable) {
            $this->getTagManager()->saveTagging($resource);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        if (($resource = $args->getEntity()) and $resource instanceof Taggable) {
            $this->getTagManager()->saveTagging($resource);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preRemove(LifecycleEventArgs $args)
    {
        if (($resource = $args->getEntity()) and $resource instanceof Taggable) {
            $this->getTagManager()->deleteTagging($resource);
        }
    }

    /**
     * Get tag manager
     *
     * @return TagManager
     */
    protected function getTagManager()
    {
        return $this->container->get('sd.tag.manager');
    }
}