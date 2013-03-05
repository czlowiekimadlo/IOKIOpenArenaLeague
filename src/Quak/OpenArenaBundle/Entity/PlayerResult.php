<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="player_results")
 */
class PlayerResult
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
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Clash", inversedBy="playerResults")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="clash_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $clash;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Player", inversedBy="results")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="player_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $player;

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

    public function setPlayer(\Quak\OpenArenaBundle\Entity\Player $player)
    {
        $this->player = $player;
    }

    public function getPlayer()
    {
        return $this->player;
    }
}
