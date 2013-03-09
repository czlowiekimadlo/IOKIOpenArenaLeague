<?php

namespace Quak\OpenArenaBundle\Service;

use Symfony\Component\HttpKernel\Kernel;

class LogParser
{
    const LOGS_DIR = "@QuakOpenArenaBundle/Resources/records/";

    protected $kernel;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function parseLog($filename)
    {
        $path = $this->kernel->locateResource(self::LOGS_DIR . $filename);
        $lines = explode("\n", str_replace(array("\r", "^7"), "", file_get_contents($path)));
        $stats = array();

        foreach ($lines as $line) {
            if (preg_match("/(.*) got the (.*) flag!/", $line, $matches)) {
                if (!isset($stats[$matches[1]])) $stats[$matches[1]] = $this->createEmptyStats();
                $stats[$matches[1]]['flag_pickups']++;
            } elseif (preg_match("/(.*) fragged (.*)'s flag carrier!/", $line, $matches)) {
                if (!isset($stats[$matches[1]])) $stats[$matches[1]] = $this->createEmptyStats();
                $stats[$matches[1]]['carriers_killed']++;
            } elseif (preg_match("/(.*) is on a killing spree with (.*) kills/", $line, $matches)) {
                if (!isset($stats[$matches[1]])) $stats[$matches[1]] = $this->createEmptyStats();
                $stats[$matches[1]]['spree']++;
            } elseif (preg_match("/(.*) was machinegunned by (.*)/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['machinegun']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) returned the (.*) flag!/", $line, $matches)) {
                if (!isset($stats[$matches[1]])) $stats[$matches[1]] = $this->createEmptyStats();
                $stats[$matches[1]]['flag_returns']++;
            } elseif (preg_match("/(.*) captured the (.*) flag!/", $line, $matches)) {
                if (!isset($stats[$matches[1]])) $stats[$matches[1]] = $this->createEmptyStats();
                $stats[$matches[1]]['flag_captures']++;
            } elseif (preg_match("/(.*) ate (.*)'s rocket/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['rocket']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) almost dodged (.*)'s rocket/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['rocket']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was melted by (.*)'s plasmagun/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['plasma']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was gunned down by (.*)/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['shotgun']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) ate (.*)'s grenade/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['grenade']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was nailed by (.*)/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['nailgun']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) falls to (.*)'s Kamikaze blast/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['kamikaze']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was too close to (.*)'s Prox Mine/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['proxy']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was shredded by (.*)'s shrapnel/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['nailgun']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was electrocuted by (.*)/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['lightning']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) got lead poisoning from (.*)'s Chaingun/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['chaingun']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was railed by (.*)/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['rail']++;
                $stats[$matches[2]]['killed']++;
            } elseif (preg_match("/(.*) was pummeled by (.*)/", $line, $matches)) {
                if (!isset($stats[$matches[2]])) $stats[$matches[2]] = $this->createEmptyStats();
                $stats[$matches[2]]['kills']['gaunlet']++;
                $stats[$matches[2]]['killed']++;
            }
        }

        return $stats;
    }

    protected function createEmptyStats()
    {
        return array(
            'flag_pickups' => 0,
            'flag_captures' => 0,
            'flag_returns' => 0,
            'carriers_killed' => 0,
            'spree' => 0,
            'killed' => 0,
            'kills' => array(
                'machinegun' => 0,
                'rocket' => 0,
                'plasma' => 0,
                'shotgun' => 0,
                'gaunlet' => 0,
                'grenade' => 0,
                'nailgun' => 0,
                'kamikaze' => 0,
                'proxy' => 0,
                'lightning' => 0,
                'chaingun' => 0,
                'rail' => 0
            )
        );
    }
}