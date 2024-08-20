<?php

namespace Spd\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use Spd\Home\Repositories\HomeRepo;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(HomeRepo $homeRepo)
    {
        return view('Home::index', compact('homeRepo'));
    }
}
