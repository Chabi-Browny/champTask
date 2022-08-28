<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Prototype\AbstractController;

class ChampionToplistController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/toplists');
    }
}
