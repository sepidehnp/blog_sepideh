<?php

namespace Spd\Home\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('Home::index');
    }
}
