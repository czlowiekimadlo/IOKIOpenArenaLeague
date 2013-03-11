<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="substitutes")
 */
class Substitute
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Player", inversedBy="substitutes")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="player_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $player;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Team", inversedBy="substitutes")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="team_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $team;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Match", inversedBy="substitutes")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="match_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $match;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function setPlayer(\Quak\OpenArenaBundle\Entity\Player $player)
    {
        $this->player = $player;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function setTeam(\Quak\OpenArenaBundle\Entity\Team $team)
    {
        $this->team = $team;
    }

    public function getMatch()
    {
        return $this->match;
    }

    public function setMatch(\Quak\OpenArenaBundle\Entity\Match $match)
    {
        $this->match = $match;
    }
}
