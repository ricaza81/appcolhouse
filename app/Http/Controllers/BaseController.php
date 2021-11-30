<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class BaseController extends Controller
{
  public function __construct()
  {
    //its just a dummy data object.
    $user = User::all();
       $zona_horaria=Carbon::now();
            $hora_zh=$zona_horaria->toTimeString();
            $hora  = date("g:i a", strtotime($hora_zh));
            $mes = $zona_horaria->formatLocalized('%B');
            $zh = Carbon::now('UTC');

    // Sharing is caring
    View::share('zona_horaria', $zona_horaria);
  }
}
