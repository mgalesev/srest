<?php

namespace SoulDock\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseFosUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 *
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 *
 * @ExclusionPolicy("all")
 */
class User extends BaseFosUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\Email
     *
     */
    protected $email;

    /**
     * @var string
     *
     * @Assert\NotBlank
     *
     */
    protected $username;
}