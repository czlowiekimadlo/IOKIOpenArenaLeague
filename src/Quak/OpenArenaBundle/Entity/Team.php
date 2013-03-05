<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="teams")
 */
class Team
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
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Season", inversedBy="teams")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="season_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $season;

    /**
     * @ORM\ManyToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Match", inversedBy="teams")
     * @ORM\JoinTable(name="teams_matches")
     */
    protected $matches;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\ClashResult", mappedBy="team", cascade={"all"})
     */
    protected $results;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Player", mappedBy="team", cascade={"all"})
     */
    protected $players;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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

    public function addResult(\Quak\OpenArenaBundle\Entity\ClashResult $result)
    {
        $this->results[] = $result;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function addPlayer(\Quak\OpenArenaBundle\Entity\Player $player)
    {
        $this->players[] = $player;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getAverageScore()
    {
        if (empty($this->results)) {
            return 0;
        }

        $sum = 0;
        $count = 0;

        foreach ($this->results as $result) {
            if ($result->getClash()->getMatch()->getWalkover()) {
                continue;
            }
            $count++;
            $sum += $result->getScore();
        }

        if ($count == 0) {
            return 0;
        }

        $average = $sum / $count;

        return floor($average + 0.5);
    }

    public function getTopResult()
    {
        if (empty($this->results)) {
            return null;
        }

        $top = null;

        foreach ($this->results as $result) {
            if ($top === null || $result->getScore() > $top->getScore()) {
                $top = $result;
            }
        }

        return $top;
    }

    public function getTotalScore()
    {
        if (empty($this->results)) {
            return 0;
        }

        $sum = 0;

        foreach ($this->results as $result) {
            if ($result->getClash()->getMatch()->getWalkover()) {
                continue;
            }
            $sum += $result->getScore();
        }

        return $sum;
    }

    public function getUpcominMatches()
    {
        $found = array();
        $now = new \DateTime('now');

        if (empty($this->matches)) {
            return array();
        }

        foreach ($this->getMatches() as $match) {
            if ($match->getDate() > $now) {
                $found[] = $match;
            }
        }

        return $found;
    }

    public function getPlayedMatches()
    {
        $found = array();
        $now = new \DateTime('now');

        if (empty($this->matches)) {
            return array();
        }

        foreach ($this->getMatches() as $match) {
            if ($match->getDate() < $now) {
                $found[] = $match;
            }
        }

        $found = array_reverse($found);

        return $found;
    }
}
