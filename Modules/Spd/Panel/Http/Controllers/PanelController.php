<?php

namespace Spd\Panel\Http\Controllers;

use App\Http\Controllers\Controller;
use Spd\Panel\Models\Panel;

class PanelController extends Controller
{
    public function index()
    {
        $this->authorize('index', Panel::class);
        return view('Panel::index');
    }
}
