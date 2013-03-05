<?php

namespace Quak\OpenArenaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clashes")
 */
class Clash
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Map", inversedBy="clashes")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="map_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $map;

    /**
     * @ORM\ManyToOne(targetEntity="\Quak\OpenArenaBundle\Entity\Match", inversedBy="clashes")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="match_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $match;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\ClashResult", mappedBy="clash", cascade={"all"})
     */
    protected $clashResults;

    /**
     * @ORM\OneToMany(targetEntity="\Quak\OpenArenaBundle\Entity\PlayerResult", mappedBy="clash", cascade={"all"})
     */
    protected $playerResults;

    /**
     * @ORM\Column(type="string")
     */
    protected $screen;

    /**
     * @ORM\Column(type="string")
     */
    protected $replay;

    public function __construct()
    {
        $this->screen = '';
        $this->replay = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMap(\Quak\OpenArenaBundle\Entity\Map $map)
    {
        $this->map = $map;
    }

    public function getMap()
    {
        return $this->map;
    }

    public function setMatch(\Quak\OpenArenaBundle\Entity\Match $match)
    {
        $this->match = $match;
    }

    public function getMatch()
    {
        return $this->match;
    }

    public function addClashResult(\Quak\OpenArenaBundle\Entity\ClashResult $result)
    {
        $this->clashResults[] = $result;
    }

    public function getClashResults()
    {
        return $this->clashResults;
    }

    public function addPlayerResult(\Quak\OpenArenaBundle\Entity\PlayerResult $result)
    {
        $this->playerResults[] = $result;
    }

    public function getPlayerResults()
    {
        return $this->playerResults;
    }

    public function getScreen()
    {
        return $this->screen;
    }

    public function setScreen($screen)
    {
        $this->screen = $screen;
    }

    public function getReplay()
    {
        return $this->replay;
    }

    public function setReplay($replay)
    {
        $this->replay = $replay;
    }

    public function getScoreForTeam($id)
    {
        foreach ($this->clashResults as $result) {
            if ($result->getTeam()->getId() == $id) {
                return $result->getScore();
            }
        }

        return 0;
    }

    public function getPlayerResultsForTeam($id)
    {
        $results = array();

        foreach ($this->playerResults as $result) {
            if ($result->getPlayer()->getTeam()->getId() == $id) {
                $results[] = $result;
            }
        }

        return $results;
    }
}
