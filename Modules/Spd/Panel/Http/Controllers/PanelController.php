<?php

namespace Spd\Panel\Http\Controllers;

use Spd\Panel\Models\Panel;
use Spd\Panel\Repositories\PanelRepo;
use Spd\Share\Http\Controllers\Controller;

class PanelController extends Controller
{

    private string $class = Panel::class;

    public function index(PanelRepo $panelRepo)
    {
        $this->authorize('index', $this->class);
        return view('Panel::index', compact('panelRepo'));
    }
}
