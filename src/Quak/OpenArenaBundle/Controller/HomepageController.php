<?php

namespace Quak\OpenArenaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function indexAction()
    {
    	$seasons = $this->getSeasons();

        $latestSeason = end($seasons);
        reset($seasons);

        $lastMatch = $latestSeason->getLastMatch();
        $nextMatch = $latestSeason->getNextMatch();

        return $this->render('QuakOpenArenaBundle:Homepage:index.html.twig', array(
        	'seasons' => $seasons,
        	'latestSeason' => $latestSeason,
        	'lastMatch' => $lastMatch,
        	'nextMatch' => $nextMatch
        ));
    }

    public function seasonAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $season = $em->getRepository('QuakOpenArenaBundle:Season')->findByNumber($id);

        if (!$season) {
            return $this->redirect($this->generateUrl('QuakOpenArenaBundle_homepage'));
        } else {
            $season = $season[0];
        }

    	$seasons = $this->getSeasons();

        $playerStats = array(
            'getAverageScore' => 'Average Score',
            'getTotalScore' => 'Total Score',
            'getAverageKills' => 'Average Kills',
            'getTotalKills' => 'Total Kills',
            'getAverageFlagCaptures' => 'Average Flag Captures',
            'getTotalFlagCaptures' => 'Total Flag Captures',
            'getAverageFlagReturns' => 'Average Flag Returns',
            'getTotalFlagReturns' => 'Total Flag Returns',
            'getAverageCarrierKills' => 'Average Carrier Kills',
            'getTotalCarrierKills' => 'Total Carrier Kills'

        );

        return $this->render('QuakOpenArenaBundle:Homepage:season.html.twig', array(
        	'seasons' => $seasons,
        	'season' => $season,
            'playerStats' => $playerStats
        ));
    }

    public function teamAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $team = $em->getRepository('QuakOpenArenaBundle:Team')->find($id);

        if (!$team) {
            return $this->redirect($this->generateUrl('QuakOpenArenaBundle_homepage'));
        }

        $seasons = $this->getSeasons();

        return $this->render('QuakOpenArenaBundle:Homepage:team.html.twig', array(
            'seasons' => $seasons,
            'team' => $team
        ));
    }

    public function matchAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $match = $em->getRepository('QuakOpenArenaBundle:Match')->find($id);

        if (!$match) {
            return $this->redirect($this->generateUrl('QuakOpenArenaBundle_homepage'));
        }

        $seasons = $this->getSeasons();

        return $this->render('QuakOpenArenaBundle:Homepage:match.html.twig', array(
            'seasons' => $seasons,
            'match' => $match
        ));
    }

    public function playerAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $player = $em->getRepository('QuakOpenArenaBundle:Player')->find($id);

        if (!$player) {
            return $this->redirect($this->generateUrl('QuakOpenArenaBundle_homepage'));
        }

        $seasons = $this->getSeasons();

        return $this->render('QuakOpenArenaBundle:Homepage:player.html.twig', array(
            'seasons' => $seasons,
            'player' => $player
        ));
    }

    protected function getSeasons()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$seasons = $em->createQueryBuilder()
            ->select('s')
            ->from('QuakOpenArenaBundle:Season',  's')
            ->addOrderBy('s.number', 'ASC')
            ->getQuery()
            ->getResult();

        return $seasons;
    }
}