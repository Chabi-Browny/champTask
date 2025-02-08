<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\Controller as AbstractController;
use App\Services\ChampionshipsService;

class MatchScoreRegisterController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/scoreReg');
    }

    public function getMatches($id)
    {
        if (!is_numeric($id))
        {
            throw new \Exception("Invalid parameters");
        }

        $champServ = new ChampionshipsService();
        $data = $champServ->getMatches($id);

        $this->setViewData('matches', $data);
        return $this->render();
    }

    public function store()
    {
        $champServ = new ChampionshipsService();

        $champId = $this->request->post('champ_id');
        $scores = $this->request->post('scores');
        $matchIds = $this->request->post('match_id');

        $this->request->validate([
            'scores.*' => 'required|max:5',
            'match_id.*' => 'required|numeric'
        ]);

        $champServ->updateMatches($champId, $scores, $matchIds);

        return redirect('/crawlToplists/'.$champId);
    }
}
