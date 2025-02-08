<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\Controller as AbstractController;
use App\Services\ChampionshipsService;

class ToplistController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/toplists');
    }

    /**/
    public function crawlToplists($champId)
    {
        $champServ = new ChampionshipsService();
        $list = $champServ->getToplists($champId);
    }

    /**/
    public function championshipToplists()
    {
        $champServ = new ChampionshipsService();
        $lists = $champServ->getAllMatchData();

        $this->setViewData('champs', $lists);

        return $this->render();
    }

}
