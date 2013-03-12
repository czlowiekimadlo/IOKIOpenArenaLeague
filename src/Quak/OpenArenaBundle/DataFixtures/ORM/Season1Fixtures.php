<?php

namespace Quak\OpenArenaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Quak\OpenArenaBundle\Entity\Season;
use Quak\OpenArenaBundle\Entity\Round;
use Quak\OpenArenaBundle\Entity\Match;
use Quak\OpenArenaBundle\Entity\Map;
use Quak\OpenArenaBundle\Entity\Team;
use Quak\OpenArenaBundle\Entity\Clash;
use Quak\OpenArenaBundle\Entity\ClashResult;
use Quak\OpenArenaBundle\Entity\Player;
use Quak\OpenArenaBundle\Entity\PlayerResult;
use Quak\OpenArenaBundle\Entity\Weapon;
use Quak\OpenArenaBundle\Entity\WeaponResult;
use Quak\OpenArenaBundle\Entity\Substitute;

class Season1Fixtures implements FixtureInterface, ContainerAwareInterface
{
    protected $maps;
    protected $teams;
    protected $manater;
    protected $players;
    protected $weapons;

    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadMaps($manager);
        $this->loadWeapons();

        $season = new Season();
        $season->setNumber(1);
        $manager->persist($season);

        $this->loadTeams($manager, $season);

        $round1 = new Round();
        $round1->setNumber(1);
        $round1->setSeason($season);
        $manager->persist($round1);

        $match = $this->createMatch(1, '05.02.2013 16:30', $round1, 'mef', 'bn', array(
            'ctf_gate1' => array(
                'team_results' => array('mef' => 1, 'bn' => 0)
            ),
            'oa_bases3plus3' => array(
                'team_results' => array('mef' => 1, 'bn' => 0)
            )
        ), true);
        $match = $this->createMatch(2, '13.02.2013 16:30', $round1, 'w', 'tau', array(
            'oa_bases3plus3' => array(
                'team_results' => array('w' => 0, 'tau' => 4),
                'player_results' => array(
                    'ddykszak' => 35,
                    'lrozniakowski' => 35,
                    'dkacban' => 15,
                    'dbudynek' => 2,
                    'akucyrka' => 35,
                    'aadamczewski' => 35,
                    'mzimny' => 32,
                    'tnebes' => 14
                ),
                'screen' => 'http://dev112.ioki.com.pl/%7Ewchojnacki/openarena/league/2013-02-13-TAU-W-bases3plus3.jpg',
                'replay' => 'http://youtu.be/Yd4ZCrdRHJM',
                'log' => '2013-02-13-tau-w-bases3plus3.txt'
            ),
            'am_thornish' => array(
                'team_results' => array('w' => 3, 'tau' => 4),
                'player_results' => array(
                    'ddykszak' => 71,
                    'dkacban' => 68,
                    'lrozniakowski' => 62,
                    'dbudynek' => 9,
                    'tnebes' => 67,
                    'mzimny' => 65,
                    'akucyrka' => 57,
                    'aadamczewski' => 56
                ),
                'screen' => 'http://dev112.ioki.com.pl/%7Ewchojnacki/openarena/league/2013-02-13-TAU-W-thornish.jpg',
                'replay' => 'http://youtu.be/fS12N3WYZ6c',
                'log' => '2013-02-13-tau-w-thornish.txt'
            )
        ));
        $match = $this->createMatch(3, '22.02.2013 16:00', $round1, 'mef', 'tau', array(
            'oa_bases3plus3' => array(
                'team_results' => array('mef' => 2, 'tau' => 8),
                'player_results' => array(
                    'rslocinski' => 31,
                    'awaleska' => 28,
                    'mgoraj' => 26,
                    'mwozniak' => 21,
                    'tnebes' => 40,
                    'aadamczewski' => 34,
                    'mzimny' => 31,
                    'akucyrka' => 28
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-02-22-MEF-TAU-bases3plus3.jpg',
                'replay' => 'http://youtu.be/oBwSMwVk35Y',
                'log' => '2013-02-22-MEF-TAU-bases3plus3.txt'
            ),
            'ctf_gate1' => array(
                'team_results' => array('mef' => 2, 'tau' => 4),
                'player_results' => array(
                    'mgoraj' => 54,
                    'mwozniak' => 39,
                    'awaleska' => 22,
                    'rslocinski' => 15,
                    'tnebes' => 56,
                    'aadamczewski' => 46,
                    'akucyrka' => 35,
                    'mzimny' => 34
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-02-22-MEF-TAU-gate1.jpg',
                'replay' => 'http://youtu.be/SSnQS6evpyM',
                'log' => '2013-02-22-MEF-TAU-gate1.txt'
            )
        ));
        $match = $this->createMatch(4, '27.02.2013 16:15', $round1, 'sd', 'w', array(
            'ctf_gate1' => array(
                'team_results' => array('sd' => 4, 'w' => 6),
                'player_results' => array(
                    'fgorny' => 44,
                    'rpalczynski' => 31,
                    'sdudek' => 24,
                    'lciolek' => 12,
                    'lrozniakowski' => 72,
                    'dkacban' => 68,
                    'ddykszak' => 56,
                    'dbudynek' => 3
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-02-27-SD-W-gate1.jpg',
                'replay' => 'http://youtu.be/Vrdd00qHePo',
                'log' => '2013-02-27-SD-W-gate1.txt'
            ),
            'oa_reptctf11' => array(
                'team_results' => array('sd' => 5, 'w' => 4),
                'player_results' => array(
                    'fgorny' => 82,
                    'rpalczynski' => 59,
                    'sdudek' => 51,
                    'lciolek' => 44,
                    'ddykszak' => 106,
                    'dkacban' => 99,
                    'lrozniakowski' => 86,
                    'dbudynek' => 18
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-02-27-SD-W-reptctf11.jpg',
                'replay' => 'http://youtu.be/6HLgcv50Smc',
                'log' => '2013-02-27-SD-W-reptctf11.txt'
            )
        ));
        $match = $this->createMatch(5, '06.03.2013 16:15', $round1, 'bn', 'w', array(
            'ctf_gate1' => array(
                'team_results' => array('bn' => 11, 'w' => 0),
                'player_results' => array(
                    'kpiwowarczyk' => 73,
                    'wchojnacki' => 56,
                    'spawlowski' => 50,
                    'mmucha' => 25,
                    'lrozniakowski' => 36,
                    'ddykszak' => 33,
                    'lpospiech' => 23,
                    'dbudynek' => 8
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-03-06-BN-W-gate1.jpg',
                'replay' => 'http://youtu.be/-L-39snLUsE',
                'log' => '2013-03-06-BN-W-gate1.txt'
            ),
            'am_thornish' => array(
                'team_results' => array('bn' => 8, 'w' => 2),
                'player_results' => array(
                    'wchojnacki' => 100,
                    'kpiwowarczyk' => 73,
                    'spawlowski' => 59,
                    'mmucha' => 40,
                    'lrozniakowski' => 60,
                    'ddykszak' => 47,
                    'lpospiech' => 45,
                    'dbudynek' => 10
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-03-06-BN-W-thornish.jpg',
                'replay' => 'http://youtu.be/Dh4d_PS4S7A',
                'log' => '2013-03-06-BN-W-thornish.txt'
            )
        ), false, array(
            array(
                'player' => 'lpospiech',
                'team' => 'w'
            )
        ));
        $match = $this->createMatch(6, '15.03.2013 16:30', $round1, 'tau', 'sd');
        $match = $this->createMatch(7, '19.03.2013 16:30', $round1, 'bn', 'sd');
        $match = $this->createMatch(8, '02.04.2013 16:30', $round1, 'w', 'mef');
        $match = $this->createMatch(9, '09.04.2013 16:30', $round1, 'tau', 'bn');
        $match = $this->createMatch(10, '16.04.2013 16:30', $round1, 'sd', 'mef');

        $round2 = new Round();
        $round2->setNumber(2);
        $round2->setSeason($season);
        $manager->persist($round2);

        $match = $this->createMatch(1, '23.04.2013 16:30', $round2, 'mef', 'bn');
        $match = $this->createMatch(2, '30.04.2013 16:30', $round2, 'tau', 'w');
        $match = $this->createMatch(3, '07.05.2013 16:30', $round2, 'tau', 'mef');
        $match = $this->createMatch(4, '14.05.2013 16:30', $round2, 'w', 'sd');
        $match = $this->createMatch(5, '21.05.2013 16:30', $round2, 'w', 'bn');
        $match = $this->createMatch(6, '28.05.2013 16:30', $round2, 'sd', 'tau');
        $match = $this->createMatch(7, '04.06.2013 16:30', $round2, 'sd', 'bn');
        $match = $this->createMatch(8, '11.06.2013 16:30', $round2, 'mef', 'w');
        $match = $this->createMatch(9, '18.06.2013 16:30', $round2, 'bn', 'tau');
        $match = $this->createMatch(10, '25.06.2013 16:30', $round2, 'mef', 'sd');

        $manager->flush();
    }

    protected function loadMaps(ObjectManager $manager)
    {
        $maps = array(
            'am_thornish',
            'cbctf1',
            'ctf_gate1',
            'oa_bases3plus3',
            'oa_reptctf11',
            'oasage2',
            'am_lavactf',
            'hydronex2',
            'ps37ctf2',
            'ps9ctf',
            'mlctf1beta',
            'oa_bases3p3ta',
            'oa_ctf2',
            'oa_ctf4ish',
            'am_lavactfxl'
        );
        foreach ($maps as $map) {
            $this->maps[$map] = new Map();
            $this->maps[$map]->setName($map);
            $manager->persist($this->maps[$map]);
        }
    }

    protected function loadWeapons()
    {
        $weapons = array(
            'gaunlet' => 'Gaunlet',
            'machinegun' => 'Machinegun',
            'shotgun' => 'Shotgun',
            'lightning' => 'Lightning Gun',
            'grenade' => 'Grenade Launcher',
            'plasma' => 'Plasmagun',
            'rocket' => 'Rocket Launcher',
            'rail' => 'Railgun',
            'nailgun' => 'Nailgun',
            'proxy' => 'Minelayer',
            'kamikaze' => 'Kamikaze Strike',
            'bfg' => 'BFG',
            'chaingun' => 'Chaingun'
        );
        foreach ($weapons as $weapon => $name) {
            $this->weapons[$weapon] = new Weapon();
            $this->weapons[$weapon]->setName($name);
            $this->manager->persist($this->weapons[$weapon]);
        }
    }

    protected function loadTeams(ObjectManager $manager, Season $season)
    {
        $teams = array(
            'mef' => 'My English Frag',
            'tau' => 'TAMA AZS UWM Indykpol Wkrętmet Majonez Kętrzyński Rataje',
            'bn'  => 'Bad News',
            'sd'  => 'S&D',
            'w'   => 'Whatever',
            'na'  => 'No team'
        );

        $players = array(
            'mef' => array(
                'mgoraj' => 'Małgorzata Góraj',
                'awaleska' => 'Adam Wałęska',
                'rslocinski' => 'Roman Słociński',
                'mwozniak' => 'Marcin Woźniak'
            ),
            'tau' => array(
                'tnebes' => 'Tomasz Nebeś',
                'akucyrka' => 'Adrian Kucyrka',
                'mzimny' => 'Marcin Zimny',
                'aadamczewski' => 'Adam Adamczewski'
            ),
            'bn'  => array(
                'kpiwowarczyk' => 'Krystian Piwowarczyk',
                'wchojnacki' => 'Wojciech Chojnacki',
                'spawlowski' => 'Szymon Pawłowski',
                'mmucha' => 'Maciej Mucha'
            ),
            'sd'  => array(
                'fgorny' => 'Filip Górny',
                'lciolek' => 'Łukasz Ciołek',
                'rpalczynski' => 'Radosław Palczyński',
                'sdudek' => 'Sebastian Dudek'
            ),
            'w'   => array(
                'lrozniakowski' => 'Leszek Rożniakowski',
                'ddykszak' => 'Daniel Dykszak',
                'dkacban' => 'Dariusz Kacban',
                'dbudynek' => 'Dariusz Budynek'
            ),
            'na'  => array(
                'mwlodek' => 'Mateusz Włodek',
                'lpospiech' => 'Łukasz Pospiech',
                'wsurmacz' => 'Wojciech Surmacz'
            )
        );

        $scores = array(
            'mef' => 3,
            'tau' => 6,
            'bn'  => 3,
            'sd'  => 0,
            'w'   => 3,
            'na'  => 0
        );

        foreach ($teams as $key => $team) {
            $newTeam = new Team();
            $newTeam->setName($team);
            $newTeam->setSeason($season);
            $newTeam->setScore($scores[$key]);
            $manager->persist($newTeam);
            $this->teams[$key] = $newTeam;

            foreach ($players[$key] as $nick => $name) {
                $player = new Player();
                $player->setName($name);
                $player->setTeam($newTeam);
                $manager->persist($player);
                $this->players[$nick] = $player;
            }
        }
    }

    protected function createMatch($num, $date, $round, $team1, $team2, $maps = array(), $walkover = false, $substitutes = array())
    {
        $match = new Match();
        $match->setNumber($num);
        $match->setDate(new \DateTime($date));
        $match->setRound($round);
        $match->setWalkover($walkover);
        $this->teams[$team1]->addMatch($match);
        $this->teams[$team2]->addMatch($match);
        $this->manager->persist($match);

        foreach ($substitutes as $substitute) {
            $newSubstitute = new Substitute();
            $newSubstitute->setTeam($this->teams[$substitute['team']]);
            $newSubstitute->setPlayer($this->players[$substitute['player']]);
            $newSubstitute->setMatch($match);
            $this->manager->persist($newSubstitute);
        }

        foreach ($maps as $mapname => $mapresults) {
            $clash = new Clash();
            $clash->setMap($this->maps[$mapname]);
            $clash->setMatch($match);
            $this->manager->persist($clash);
            $match->addClash($clash);

            if (isset($mapresults['log'])) {
                $playersStats = $this->container->get('logParser')->parseLog($mapresults['log']);
            } else {
                $playersStats = array();
            }

            if (isset($mapresults['team_results'])) {
                foreach ($mapresults['team_results'] as $team => $score) {
                    $clashResult = new ClashResult();
                    $clashResult->setScore($score);
                    $clashResult->setClash($clash);
                    $clashResult->setTeam($this->teams[$team]);
                    $this->manager->persist($clashResult);
                }
            }
            if (isset($mapresults['player_results'])) {
                foreach ($mapresults['player_results'] as $nick => $score) {
                    $playerResult = new PlayerResult();
                    $playerResult->setScore($score);
                    $playerResult->setClash($clash);
                    $playerResult->setPlayer($this->players[$nick]);

                    $playerStats = $this->matchPlayerStats($nick, $playersStats);

                    if (!empty($playerStats)) {
                        $this->appendPlayerStats($playerResult, $playerStats);
                    }

                    $this->manager->persist($playerResult);
                }
            }
            if (isset($mapresults['screen'])) {
                $clash->setScreen($mapresults['screen']);
            }
            if (isset($mapresults['replay'])) {
                $clash->setReplay($mapresults['replay']);
            }
        }

        return $match;
    }

    protected function matchPlayerStats($nick, $stats)
    {
        $nickmap = array(
            'mgoraj' => 'Kaczumbinator',
            'awaleska' => 'Ketrzynski ssie',
            'rslocinski' => 'SirHeadly',
            'mwozniak' => 'MarW',
            'tnebes' => array('vagino_rossi', 'TNebes'),
            'akucyrka' => 'kuyk',
            'mzimny' => array('Kaltgesicht', 'Coldface'),
            'aadamczewski' => array('Bozenka', 'AAdAmCzEwSkI'),
            'kpiwowarczyk' => 'KrysPiwo',
            'wchojnacki' => 'CzlowiekImadlo',
            'spawlowski' => 'kit',
            'mmucha' => 'MM',
            'fgorny' => 'Filip',
            'lciolek' => 'EloRap',
            'rpalczynski' => 'radepal',
            'sdudek' => 'd3dik',
            'lrozniakowski' => 'lrozniakowski',
            'ddykszak' => 'WhySoSerious',
            'dkacban' => 'Kot Schrodingera',
            'dbudynek' => 'Dario',
            'mwlodek' => null,
            'lpospiech' => 'ZoCiM',
            'wsurmacz' => null
        );

        if(is_array($nickmap[$nick])) {
            foreach ($nickmap[$nick] as $matchnick) {
                if (isset($stats[$matchnick])) return $stats[$matchnick];
            }
        } else {
            if (isset($stats[$nickmap[$nick]])) return $stats[$nickmap[$nick]];
        }

        return array();
    }

    protected function appendPlayerStats(PlayerResult $result, $stats)
    {
        $result->setKills($stats['killed']);
        $result->setCarrierKills($stats['carriers_killed']);
        $result->setFlagCaptures($stats['flag_captures']);
        $result->setFlagPickups($stats['flag_pickups']);
        $result->setFlagReturns($stats['flag_returns']);
        $result->setSprees($stats['spree']);
        foreach ($stats['kills'] as $weaponName => $kills) {
            $weaponResult = new WeaponResult();
            $weaponResult->setScore($kills);
            $weaponResult->setWeapon($this->weapons[$weaponName]);
            $weaponResult->setPlayerResult($result);
            $this->manager->persist($weaponResult);
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
