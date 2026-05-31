<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard. Placeholder until the real dashboard is built.
     */
    public function index(): View
    {
        return view('backend.dashboard.index');
    }
}
