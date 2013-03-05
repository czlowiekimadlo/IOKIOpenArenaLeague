<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    public function getAverageScore()
    {
        if (count($this->results) == 0) {
            return 0;
        }

        $sum = 0;
        $count = 0;

        foreach ($this->results as $result) {
            $count++;
            $sum += $result->getScore();
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
            $sum += $result->getScore();
        }

        return $sum;
    }
}
