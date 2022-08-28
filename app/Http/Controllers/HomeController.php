<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;
//use Illuminate\Http\Client\Request;
//use Illuminate\Http\Request;

class HomeController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/welcome');
    }
}
