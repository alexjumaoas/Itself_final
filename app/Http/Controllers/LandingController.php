<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function landingPage(){

        return view('landingPage.index');
    }

    public function unauthorize(){
        return view('unauthorize');
    }
}
