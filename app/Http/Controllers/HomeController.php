<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected HomeService $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function home(): View
    {
        $dashboardData = $this->homeService->getDashboardData();
        return view('home', $dashboardData);
    }
}
