<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Quak\OpenArenaBundle\Entity\WeaponResult;

/**
 * @ORM\Entity
 * @ORM\Table(name="players")
 */
class Player
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
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Team", inversedBy="players")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="team_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $team;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\PlayerResult", mappedBy="player", cascade={"all"})
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

    public function setTeam(\Quak\OpenArenaBundle\Entity\Team $team)
    {
        $this->team = $team;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function addResult(\Quak\OpenArenaBundle\Entity\PlayerResult $result)
    {
        $this->results[] = $result;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getAverageStat($name)
    {
        if (count($this->results) == 0) {
            return 0;
        }

        $sum = 0;
        $count = 0;

        foreach ($this->results as $result) {
            $count++;
            $sum += $result->$name();
        }

        $average = $sum / $count;

        return round($average, 1);
    }

    public function getTotalStat($name)
    {
        if (empty($this->results)) {
            return 0;
        }

        $sum = 0;

        foreach ($this->results as $result) {
            $sum += $result->$name();
        }

        return $sum;
    }

    public function getAverageScore()
    {
        return $this->getAverageStat('getScore');
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
        return $this->getTotalStat('getScore');
    }

    public function getAverageKills()
    {
        return $this->getAverageStat('getKills');
    }
    public function getTotalKills()
    {
        return $this->getTotalStat('getKills');
    }

    public function getAverageCarrierKills()
    {
        return $this->getAverageStat('getCarrierKills');
    }
    public function getTotalCarrierKills()
    {
        return $this->getTotalStat('getCarrierKills');
    }

    public function getAverageFlagCaptures()
    {
        return $this->getAverageStat('getFlagCaptures');
    }
    public function getTotalFlagCaptures()
    {
        return $this->getTotalStat('getFlagCaptures');
    }

    public function getAverageFlagPickups()
    {
        return $this->getAverageStat('getFlagPickups');
    }
    public function getTotalFlagPickups()
    {
        return $this->getTotalStat('getFlagPickups');
    }

    public function getAverageFlagReturns()
    {
        return $this->getAverageStat('getFlagReturns');
    }
    public function getTotalFlagReturns()
    {
        return $this->getTotalStat('getFlagReturns');
    }

    public function getAverageSprees()
    {
        return $this->getAverageStat('getSprees');
    }
    public function getTotalSprees()
    {
        return $this->getTotalStat('getSprees');
    }

    public function getTotalWeaponResults()
    {
        $out = array();

        foreach ($this->results as $result) {
            foreach ($result->getWeaponResults() as $weaponResult) {
                if ($weaponResult->getScore() > 0) {
                    if (empty($out[$weaponResult->getWeapon()->getName()])) {
                        $out[$weaponResult->getWeapon()->getName()] = new WeaponResult();
                        $out[$weaponResult->getWeapon()->getName()]->setWeapon($weaponResult->getWeapon());
                    }
                    $out[$weaponResult->getWeapon()->getName()]->setScore($out[$weaponResult->getWeapon()->getName()]->getScore() + $weaponResult->getScore());
                }
            }
        }

        return $out;
    }
}
