<?php

namespace Spd\Auth\Http\Controllers;

use Spd\Share\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return to_route('home.index');
    }
}
