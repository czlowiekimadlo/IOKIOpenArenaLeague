<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clash_results")
 */
class ClashResult
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
    protected $score;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Clash", inversedBy="clashResults")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="clash_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $clash;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Team", inversedBy="results")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="team_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $team;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function setClash(\Quak\OpenArenaBundle\Entity\Clash $clash)
    {
        $this->clash = $clash;
    }

    public function getClash()
    {
        return $this->clash;
    }

    public function setTeam(\Quak\OpenArenaBundle\Entity\Team $team)
    {
        $this->team = $team;
    }

    public function getTeam()
    {
        return $this->team;
    }
}
