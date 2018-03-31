<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new instance of this controller
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activated');
    }

    /**
     * Show the application's dashboard
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
