<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;

class ChampionRegisterController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/register');
        $this->setViewData('jsPart', 'jsRegister');
    }

    public function store()
    {
        $retVal = null;
        $teamPars = $this->request->post("teamsPairs");
        $champName = $this->request->post("champName");

        if (!is_array($teamPars) || count($teamPars) === 0 || empty($champName))
        {
            throw new \Exception("Invalid parameters");
        }
        return false; // temporary return value
    }

}
