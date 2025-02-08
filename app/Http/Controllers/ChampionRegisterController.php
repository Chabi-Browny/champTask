<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\Controller as AbstractController;
use App\Services\ChampionshipsService;
use Illuminate\Http\JsonResponse;

/**/
class ChampionRegisterController extends AbstractController
{
    /**/
    public function init()
    {
        $this->setViewName('pages/register');
        $this->setViewData('jsPart', 'jsRegister');
    }

    /**/
    public function store(): JsonResponse
    {
        $teamPairs = $this->request->post("teamsPairs");
        $teamList = $this->request->post("teams");
        $champName = $this->request->post("champ_name");

        $this->request->validate([
            'champ_name' =>  'unique:championships,name|required|max:125|min:3',

            'teamPairs.*.tmname' => 'unique:teams,name|required|max:125|min:3',
            'teamPairs.*.p1' => 'required|max:125|min:3',
            'teamPairs.*.p2' => 'required|max:125|min:3',

            'teams.*.tmname' => 'unique:teams,name|required|max:125|min:3',
            'teams.*.p1' => 'required|max:125|min:3',
            'teams.*.p2' => 'required|max:125|min:3',
        ]);

        if ( !is_array($teamList) || count($teamList) === 0 )
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

        return new JsonResponse([
                'message' => 'Register the championship matches',
                'success' => 'Registration success!',
                'campId' => $champId
            ],
            200,
            ['Content-type' => 'application/json']
        );
    }

}
