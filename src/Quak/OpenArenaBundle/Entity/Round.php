<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="rounds")
 */
class Round
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $number;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Season", inversedBy="rounds")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="season_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $season;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Match", mappedBy="round", cascade={"all"})
     */
    protected $matches;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setSeason(\Quak\OpenArenaBundle\Entity\Season $season)
    {
        $this->season = $season;
    }

    public function getSeason()
    {
        return $this->season;
    }

    public function addMatch(\Quak\OpenArenaBundle\Entity\Match $match)
    {
        $this->matches[] = $match;
    }

    public function getMatches()
    {
        return $this->matches;
    }

    public function getNextMatch()
    {
        $found = null;
        $now = new \DateTime('now');

        if (empty($this->matches)) {
            return null;
        }

        foreach ($this->matches as $match) {
            if ($match->getDate() > $now) {
                if ($found === null || $match->getNumber() < $found->getNumber()) {
                    $found = $match;
                }
            }
        }

        return $found;
    }

    public function getLastMatch()
    {
        $found = null;
        $now = new \DateTime('now');

        if (empty($this->matches)) {
            return null;
        }

        foreach ($this->matches as $match) {
            if ($match->getDate() < $now) {
                if ($found === null || $match->getNumber() > $found->getNumber()) {
                    $found = $match;
                }
            }
        }

        return $found;
    }

}
