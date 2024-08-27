<?php

namespace Spd\Home\Http\Controllers;

use Spd\Home\Repositories\HomeRepo;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(HomeRepo $homeRepo)
    {
        return view('Home::index', compact(['homeRepo']));
    }
}
