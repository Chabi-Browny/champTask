<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;
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
        $lists = $champServ->getToplists($champId);

    }
}
