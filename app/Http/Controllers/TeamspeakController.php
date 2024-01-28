<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PlanetTeamSpeak\TeamSpeak3Framework\TeamSpeak3;
use PlanetTeamSpeak\TeamSpeak3Framework\TeamSpeak3_Exception;

class TeamspeakController extends Controller
{
    public $TS3PHPFramework = null;
    public $ts3_VirtualServer = null;

    public $playerGroup = 7;
    
    public function __construct() {
        $this->TS3PHPFramework = new TeamSpeak3();
        $this->ts3_VirtualServer = $this->TS3PHPFramework->factory("serverquery://serveradmin:".rawurlencode("MgyS4S+o")."@88.198.117.158:10011/?server_port=9987");
    }

    public function syncPlayer($verification) {
        if(!$this->ts3_VirtualServer) {
            return;
        }
        $this->ts3_VirtualServer->clientGetByUid("$verification")->addServerGroup($this->playerGroup);
    }

    public function revokePlayer($verification) {
        if(!$this->ts3_VirtualServer) {
            return;
        }
        $this->ts3_VirtualServer->clientGetByUid("$verification")->remServerGroup($this->playerGroup);
    }
}
