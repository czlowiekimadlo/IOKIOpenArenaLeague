<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="matches")
 */
class Match
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
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Round", inversedBy="matches")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="round_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $round;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $walkover;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\ManyToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Team", mappedBy="matches", cascade={"all"})
     */
    protected $teams;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Clash", mappedBy="match", cascade={"all"})
     */
    protected $clashes;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\Substitute", mappedBy="match", cascade={"all"})
     */
    protected $substitutes;

    public function __construct()
    {
        $this->walkover = false;
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

    public function setRound(\Quak\OpenArenaBundle\Entity\Round $round)
    {
        $this->round = $round;
    }

    public function getRound()
    {
        return $this->round;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setWalkover($walkover)
    {
        $this->walkover = $walkover;
    }

    public function getWalkover()
    {
        return $this->walkover;
    }

    public function addTeam(\Quak\OpenArenaBundle\Entity\Team $team)
    {
        $this->teams[] = $team;
    }

    public function getTeams()
    {
        return $this->teams;
    }

    public function addClash(\Quak\OpenArenaBundle\Entity\Clash $clash)
    {
        $this->clashes[] = $clash;
    }

    public function getClashes()
    {
        return $this->clashes;
    }

    public function addSubstitute(\Quak\OpenArenaBundle\Entity\Substitute $substitute)
    {
        $this->substitutes[] = $substitute;
    }

    public function getSubstitutes()
    {
        return $this->substitutes;
    }
}
