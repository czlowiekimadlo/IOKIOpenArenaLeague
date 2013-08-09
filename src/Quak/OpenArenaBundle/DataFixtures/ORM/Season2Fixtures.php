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
use Quak\OpenArenaBundle\Entity\Group;

class Season2Fixtures implements FixtureInterface, ContainerAwareInterface
{
    protected $manager;
    protected $maps;
    protected $teams;
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
        $season->setNumber(2);
        $season->setCtf(0);
        $manager->persist($season);

        $this->loadTeams($manager, $season);

        $round1 = new Round();
        $round1->setNumber(1);
        $round1->setSeason($season);
        $manager->persist($round1);

        $match = $this->createMatch(1, '30.07.2013 16:30', $round1, 'edi', 'tsm', array(
            'DM-Tempest' => array(
                'team_results' => array('edi' => 37, 'tsm' => 36),
                'player_results' => array(
                    'rslocinski' => 21,
                    'mwlodek' => 11,
                    'mgoraj' => 5,
                    'tnebes' => 18,
                    'aadamczewski' => 13,
                    'akucyrka' => 5,
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-07-30-edi-tsm-tempest.jpg',
            ),
            'DM-HyperBlast' => array(
                'team_results' => array('edi' => 5, 'tsm' => 35),
                'player_results' => array(
                    'rslocinski' => 3,
                    'mgoraj' => 3,
                    'mwlodek' => -1,
                    'tnebes' => 18,
                    'akucyrka' => 9,
                    'aadamczewski' => 8,
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-07-30-edi-tsm-hyperblast.jpg',
            )
        ));
        $match = $this->createMatch(2, '01.08.2013 16:30', $round1, 'sd', 'w', array(
            'DM-Grinder' => array(
                'team_results' => array('sd' => 48, 'w' => 40),
                'player_results' => array(
                    'rpalczynski' => 19,
                    'lciolek' => 17,
                    'sdudek' => 12,
                    'lrozniakowski' => 18,
                    'dkacban' => 12,
                    'ssadlo' => 10,
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-08-01-sd-w-grinder.jpg',
            ),
            'DM-Deck16][' => array(
                'team_results' => array('sd' => 33, 'w' => 21),
                'player_results' => array(
                    'sdudek' => 19,
                    'rpalczynski' => 10,
                    'lciolek' => 4,
                    'ssadlo' => 14,
                    'lrozniakowski' => 4,
                    'dkacban' => 3,
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-08-01-sd-w-deck.jpg',
            )
        ), false, array(
            array(
                'player' => 'ssadlo',
                'team' => 'w'
            )
        ));
        $match = $this->createMatch(3, '08.08.2013 16:30', $round1, 'sd', '-2', array(
            'DM-Deck16][' => array(
                'team_results' => array('sd' => 41, '-2' => 43),
                'player_results' => array(
                    'rpalczynski' => 20,
                    'sdudek' => 11,
                    'lciolek' => 10,
                    'mjaniszewski' => 20,
                    'cnosek' => 13,
                    'sgrzmiel' => 10,
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-08-08-sd-2-deck.jpg',
            ),
            'DM-Grinder' => array(
                'team_results' => array('sd' => 38, '-2' => 31),
                'player_results' => array(
                    'lciolek' => 15,
                    'rpalczynski' => 12,
                    'sdudek' => 11,
                    'mjaniszewski' => 16,
                    'cnosek' => 11,
                    'sgrzmiel' => 4,
                ),
                'screen' => 'http://dev112.ioki.com.pl/~wchojnacki/openarena/league/2013-08-08-sd-2-grinder.jpeg',
            )
        ));
        $match = $this->createMatch(4, '13.08.2013 16:30', $round1, 'tsm', 'bn');
        $match = $this->createMatch(5, '20.08.2013 16:30', $round1, 'edi', 'bn');
        $match = $this->createMatch(6, '22.08.2013 16:30', $round1, 'w', '-2');

        $round2 = new Round();
        $round2->setNumber(2);
        $round2->setSeason($season);
        $manager->persist($round2);

        $match = $this->createMatch(1, '27.08.2013 16:30', $round2, 'tsm', 'edi');
        $match = $this->createMatch(2, '29.08.2013 16:30', $round2, 'w', 'sd');
        $match = $this->createMatch(3, '03.09.2013 16:30', $round2, 'bn', 'edi');
        $match = $this->createMatch(4, '05.09.2013 16:30', $round2, '-2', 'sd');
        $match = $this->createMatch(5, '10.09.2013 16:30', $round2, 'bn', 'tsm');
        $match = $this->createMatch(6, '12.09.2013 16:30', $round2, '-2', 'w');

        $manager->flush();
    }

    protected function loadMaps(ObjectManager $manager)
    {
        $maps = array(
            'DM-Agony',
            'DM-ArcaneTemple',
            'DM-Barricade',
            'DM-Codex',
            'DM-Curse][',
            'DM-Cybrosis][',
            'DM-Deck16][',
            'DM-Grinder',
            'DM-HealPod][',
            'DM-HyperBlast',
            'DM-Liandri',
            'DM-Malevolence',
            'DM-Morpheus',
            'DM-Peak',
            'DM-Phobos',
            'DM-Pressure',
            'DM-Shrapnel][',
            'DM-Stalwart',
            'DM-StalwartXL',
            'DM-Tempest',
            'DM-Turbine',
            'DM-Zeto'
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
            'impact' => 'Impact Hammer',
            'enforcer' => 'Enforcer',
            'akimbo' => 'Double Enforcer',
            'bio' => 'GES BioRifle',
            'shock' => 'ASMD Shock Rifle',
            'pulse' => 'Pulse Gun',
            'ripper' => 'Razorjack',
            'minigun' => 'Minigun',
            'flak' => 'Flak Cannon',
            'rocket' => 'Rocket Launcher',
            'sniper' => 'Sniper Rifle',
            'redeemer' => 'Redeemer',
            'tele' => 'Teleporter'
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
            'edi' => 'Flugabwehrkanonenpanzer EDI - Editorial Destruction Incentive',
            'tsm' => 'TAMA SKAMA Market Huta Szkła Violetta Pepco PHU MotoKram Bentkowski Społem Rynek Jeżycki Przewozy Regionalne Wielkopolska CHO NO TU',
            'bn'  => 'Bad News',
            'sd'  => 'S&D',
            'w'   => 'Whatever',
            '-2'  => '-2',
            'na'  => 'No team'
        );

        $players = array(
            'edi' => array(
                'mgoraj' => 'Małgorzata Góraj',
                'mwlodek' => 'Mateusz Włodek',
                'rslocinski' => 'Roman Słociński'
            ),
            'tsm' => array(
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
                'lciolek' => 'Łukasz Ciołek',
                'rpalczynski' => 'Radosław Palczyński',
                'sdudek' => 'Sebastian Dudek',
                'djurga' => 'Dawid Jurga'
            ),
            'w'   => array(
                'lrozniakowski' => 'Leszek Rożniakowski',
                'dkacban' => 'Dariusz Kacban',
                'dbudynek' => 'Dariusz Budynek',
                'khorowski' => 'Karol Horowski'
            ),
            '-2'  => array(
                'mjaniszewski' => 'Maciej Janiszewski',
                'sgrzmiel' => 'Sławomir Grzmiel',
                'cnosek' => 'Cypiran Nosek'
            ),
            'na'  => array(
                'klodzikowski' => 'Kacper Łodzikowski',
                'ssadlo' => 'Szymon Sadło',
                'dfryc' => 'Daniel Fryc',
                'jromaniuk' => 'Jarosław Romaniuk'
            )
        );

        $groups = array(
            'A' => array(
                'edi',
                'tsm',
                'bn'
            ),
            'B' => array(
                'sd',
                'w',
                '-2'
            )
        );

        $scores = array(
            'edi' => 0,
            'tsm' => 3,
            'bn'  => 0,
            'sd'  => 6,
            'w'   => 0,
            '-2'  => 0,
            'na'  => 0
        );

        $logos = array(
            'edi' => 'utlogo.gif',
            'tsm' => 'utlogo.gif',
            'bn'  => 'bn.jpg',
            'sd'  => 'sd.jpg',
            'w'   => 'w.jpg',
            '-2'  => 'utlogo.gif',
            'na'  => 'utlogo.gif',
        );

        foreach ($teams as $key => $team) {
            $newTeam = new Team();
            $newTeam->setName($team);
            $newTeam->setShort(strtoupper($key));
            $newTeam->setSeason($season);
            $newTeam->setScore($scores[$key]);
            $newTeam->setLogo($logos[$key]);
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

        foreach ($groups as $groupName => $teams) {
            $group = new Group();
            $group->setName($groupName);
            foreach ($teams as $team) {
                $this->teams[$team]->setGroup($group);
                $group->addTeam($this->teams[$team]);
            }
            $manager->persist($group);
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
            'mgoraj' => array('Kaczumbinator', 'Kaczumba', 'Malgorzata I'),
            'awaleska' => 'Ketrzynski ssie',
            'rslocinski' => 'SirHeadly',
            'mwozniak' => array('MarW', "Don't Shoot", 'Marw'),
            'tnebes' => array('vagino_rossi', 'TNebes', 'vaginoRossi'),
            'akucyrka' => 'kuyk',
            'mzimny' => array('Kaltgesicht', 'Coldface'),
            'aadamczewski' => array('Bozenka', 'AAdAmCzEwSkI'),
            'kpiwowarczyk' => 'KrysPiwo',
            'wchojnacki' => 'CzlowiekImadlo',
            'spawlowski' => 'kit',
            'mmucha' => 'MM',
            'fgorny' => 'Filip',
            'lciolek' => array('EloRap', 'BackendDeveloper'),
            'rpalczynski' => 'radepal',
            'sdudek' => array('d3dik'),
            'lrozniakowski' => 'lrozniakowski',
            'ddykszak' => 'WhySoSerious',
            'dkacban' => 'Kot Schrodingera',
            'dbudynek' => 'Dario',
            'mwlodek' => array('Wolodymyr', 'Wladyslaw', 'Wladyslaw III'),
            'lpospiech' => 'ZoCiM',
            'wsurmacz' => null,
            'dmasztalerz' => 'MASZTI',
            'djurga' => 'Gummmibear',
            'khorowski' => 'karol',
            'ssadlo' => 'beriba',
            'mjaniszewski' => 'Maciej',
            'sgrzmiel' => 'Slawek_-2',
            'cnosek' => 'Cypi_Pogromca_Dudkow'
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
        return 2;
    }
}
