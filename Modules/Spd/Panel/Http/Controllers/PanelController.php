<?php

namespace Spd\Panel\Http\Controllers;

use Spd\Share\Http\Controllers\Controller;
use Spd\Panel\Models\Panel;

class PanelController extends Controller
{

    private string $class = Panel::class;

    public function index()
    {
        $this->authorize('index', $this->class);
        return view('Panel::index');
    }
}
