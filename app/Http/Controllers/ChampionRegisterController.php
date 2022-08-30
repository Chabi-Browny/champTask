<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;
use App\Services\ChampionshipsService;
use Illuminate\Http\JsonResponse;

class ChampionRegisterController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/register');
        $this->setViewData('jsPart', 'jsRegister');
    }

    public function store()
    {
        $teamPairs = $this->request->post("teamsPairs");
        $teamList = $this->request->post("teamlist");
        $champName = $this->request->post("champName");

        if ((!is_array($teamPairs) || !is_array($teamList))
            || (count($teamPairs) === 0 || count($teamList) === 0)
            || empty($champName))
        {
            throw new \Exception("Invalid parameters");
        }

        $champServ = new ChampionshipsService();

        $teamIds = [];
        foreach ($teamList as $team)
        {
            $playersIds = $champServ->addPlayer($team);

            $teamInfo = $champServ->addTeams($team, $playersIds);
            $teamIds[$teamInfo['name']] = $teamInfo['id'];
        }

        $champId = $champServ->addChampionship($champName);

        $champServ->addMatches($teamPairs, $teamIds, $champId);


        return new JsonResponse(['success' => 'Registration success!', 'campId' => $champId], 200, ['Content-type' => 'application/json']);
    }

}
