<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="maps")
 */
class Map
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Clash", mappedBy="map", cascade={"all"})
     */
    protected $clashes;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addClash(\Quak\OpenArenaBundle\Entity\Clash $clash)
    {
        $this->clashes[] = $clash;
    }

    public function getClashes()
    {
        return $this->clashes;
    }
}
