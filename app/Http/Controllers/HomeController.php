<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $zona_horaria=Carbon::now();
            $hora_zh=$zona_horaria->toTimeString();
            $hora  = date("g:i a", strtotime($hora_zh));
            $mes = $zona_horaria->formatLocalized('%B');
            $zh = Carbon::now('UTC');

        return view('properties', compact('zona_horaria'));
        //return view('properties');
    }

    
}
