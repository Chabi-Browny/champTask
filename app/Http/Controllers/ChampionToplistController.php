<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\Controller as AbstractController;
use App\Services\ChampionshipsService;

class ChampionToplistController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/toplists');
    }

    public function listToplists($champId)
    {
        $champServ = new ChampionshipsService();
        $list = $champServ->getToplists($champId);

    }

    public function toplists()
    {
        $champServ = new ChampionshipsService();
        $lists = $champServ->getChampionships();

        $this->setViewData('champs', $lists);

        return $this->render();
    }

}
