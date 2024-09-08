<?php

namespace Spd\Home\Http\Controllers;

use Spd\Home\Repositories\HomeRepo;
use Spd\Share\Http\Controllers\Controller;
use Spd\Advertising\Models\Advertising;
use Spd\Advertising\Repositories\AdvertisingRepo;

class HomeController extends Controller
{
    public function index(HomeRepo $homeRepo, AdvertisingRepo $advertisingRepo)

    {
        $adv_top = $advertisingRepo->getAdvByLocation(Advertising::LOCATION_TOP_MAIN_PAGE)->latest()->first();
        $adv_bottom = $advertisingRepo->getAdvByLocation(Advertising::LOCATION_BOTTOM_MAIN_PAGE)->latest()->first();

      return view('Home::index', compact(['homeRepo', 'adv_top', 'adv_bottom']));    }
}
