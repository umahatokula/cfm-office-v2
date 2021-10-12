<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    function index() {
		// dd(request->all());
        return view('frontend.pages.dashboard.views.index');
    }

    function create() {
		// dd(request->all());
        return view('frontend.pages.dashboard.views.create');
    }
}
