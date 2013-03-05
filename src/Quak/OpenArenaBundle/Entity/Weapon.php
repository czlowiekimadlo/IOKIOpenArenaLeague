<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="weapons")
 */
class Weapon
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
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\WeaponResult", mappedBy="weapon", cascade={"all"})
     */
    protected $results;

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

    public function addResult(\Quak\OpenArenaBundle\Entity\WeaponResult $result)
    {
        $this->results[] = $result;
    }

    public function getResults()
    {
        return $this->results;
    }
}
