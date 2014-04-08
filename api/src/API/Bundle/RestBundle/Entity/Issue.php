<?php

namespace API\Bundle\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ORM\Entity
 * @ORM\Table(name="issue")
 *
 * @ExclusionPolicy("none")
 */
class Issue
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @Exclude
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="issues")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    protected $item;
} 