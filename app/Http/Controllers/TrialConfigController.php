<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TrialConfigController extends Controller
{
    

    public function getData(){
        //get all config
        $value = Config::all();

        //get specific part of the config
        // $value = Config::get('app.timezone');
        // $value = Config::get('view.compiled');

        //with default 
        $value = Config::get('view.dragon','default_dragon');

        dd($value);

    }


}
