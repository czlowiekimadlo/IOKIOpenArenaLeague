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
     * @ORM\Column(type="integer")
     */
    protected $flagCaptures;

    /**
     * @ORM\Column(type="integer")
     */
    protected $flagPickups;

    /**
     * @ORM\Column(type="integer")
     */
    protected $flagReturns;

    /**
     * @ORM\Column(type="integer")
     */
    protected $carrierKills;

    /**
     * @ORM\Column(type="integer")
     */
    protected $sprees;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\WeaponResult", mappedBy="playerResult", cascade={"all"})
     */
    protected $weaponResults;

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

    public function __construct()
    {
        $this->flagCaptures = 0;
        $this->flagPickups = 0;
        $this->flagReturns = 0;
        $this->carrierKills = 0;
        $this->sprees = 0;
    }

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

    public function setFlagCaptures($score)
    {
        $this->flagCaptures = $score;
    }

    public function getFlagCaptures()
    {
        return $this->flagCaptures;
    }

    public function setFlagPickups($score)
    {
        $this->flagPickups = $score;
    }

    public function getFlagPickups()
    {
        return $this->flagPickups;
    }

    public function setFlagReturns($score)
    {
        $this->flagReturns = $score;
    }

    public function getFlagReturns()
    {
        return $this->flagReturns;
    }

    public function setCarrierKills($score)
    {
        $this->carrierKills = $score;
    }

    public function getCarrierKills()
    {
        return $this->carrierKills;
    }

    public function setSprees($score)
    {
        $this->sprees = $score;
    }

    public function getSprees()
    {
        return $this->sprees;
    }

    public function addWeaponResult(\Quak\OpenArenaBundle\Entity\WeaponResult $result)
    {
        $this->weaponResults[] = $result;
    }

    public function getWeaponResults()
    {
        return $this->weaponResults;
    }
}
