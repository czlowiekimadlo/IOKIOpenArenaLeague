<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="weapon_results")
 */
class WeaponResult
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
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Weapon", inversedBy="results")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="weapon_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $weapon;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\PlayerResult", inversedBy="weaponResults")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="player_result_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $playerResult;

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

    public function setWeapon(\Quak\OpenArenaBundle\Entity\Weapon $weapon)
    {
        $this->weapon = $weapon;
    }

    public function getWeapon()
    {
        return $this->weapon;
    }

    public function setPlayerResult(\Quak\OpenArenaBundle\Entity\PlayerResult $playerResult)
    {
        $this->playerResult = $playerResult;
    }

    public function getPlayerResult()
    {
        return $this->playerResult;
    }
}
