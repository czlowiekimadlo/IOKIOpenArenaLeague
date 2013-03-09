<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="seasons")
 */
class Season
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
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Round", mappedBy="season", cascade={"all"})
     */
    protected $rounds;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Team", mappedBy="season", cascade={"all"})
     */
    protected $teams;

    public function __construct()
    {
        $this->rounds = new ArrayCollection();
        $this->teams = new ArrayCollection();
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

    public function addRound(\Quak\OpenArenaBundle\Entity\Round $round)
    {
        $this->rounds[] = $round;
    }

    public function getRounds()
    {
        return $this->rounds;
    }

    public function getRoundIds()
    {
        $rounds = array();
        foreach ($this->getRounds() as $round) {
            $rounds[] = $round->getId();
        }

        return $rounds;
    }

    public function addTeam(\Quak\OpenArenaBundle\Entity\Team $team)
    {
        $this->teams[] = $team;
    }

    public function getTeams()
    {
        return $this->teams;
    }

    public function getNextMatch()
    {
        $found = null;
        $now = new \DateTime('now');

        if (empty($this->rounds)) {
            return null;
        }

        foreach ($this->rounds as $round) {
            $match = $round->getNextMatch();
            if ($match === null) {
                continue;
            }
            if ($found === null || $match->getRound()->getNumber() < $found->getRound()->getNumber()) {
                $found = $match;
            }
        }

        return $found;
    }

    public function getUpcominMatches()
    {
        $found = array();
        $now = new \DateTime('now');

        if (empty($this->rounds)) {
            return array();
        }

        foreach ($this->rounds as $round) {
            foreach ($round->getMatches() as $match) {
                if ($match->getDate() > $now) {
                    $found[] = $match;
                }
            }
        }

        return $found;
    }

    public function getLastMatch()
    {
        $found = null;
        $now = new \DateTime('now');

        if (empty($this->rounds)) {
            return null;
        }

        foreach ($this->rounds as $round) {
            $match = $round->getLastMatch();
            if ($match === null) {
                continue;
            }
            if ($found === null || $match->getRound()->getNumber() > $found->getRound()->getNumber()) {
                $found = $match;
            }
        }

        return $found;
    }

    public function getPlayedMatches()
    {
        $found = array();
        $now = new \DateTime('now');

        if (empty($this->rounds)) {
            return array();
        }

        foreach ($this->rounds as $round) {
            foreach ($round->getMatches() as $match) {
                if ($match->getDate() < $now) {
                    $found[] = $match;
                }
            }
        }

        $found = array_reverse($found);

        return $found;
    }

    public function getTopPlayers()
    {
        $players = array();

        foreach ($this->teams as $team) {
            foreach ($team->getPlayers() as $player) {
                $players[] = $player;
            }
        }

        usort($players, function($a, $b) {
            return ($a->getAverageScore() < $b->getAverageScore()) ? 1 : -1;
        });

        return $players;
    }

    public function getTopTeams()
    {
        $teams = array();
        foreach ($this->teams as $team) {
            $teams[] = $team;
        }

        usort($teams, function($a, $b) {
            return $a->getAverageScore() < $b->getAverageScore() ? 1 : -1;
        });

        return $teams;
    }
}
