<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

use App\Models\Day;
use App\Models\Timetable;
use App\Models\AcademicPeriod;

class DashboardController extends Controller
{
    /**
     * Create a new instance of this controller
     *
     */
    public function __construct(DashboardService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
        $this->middleware('activated');
    }

    /**
     * Show the application's dashboard
     */
    public function index()
    {
        $data = $this->service->getData();
        $timetables = Timetable::orderBy('created_at', 'DESC')->paginate(10);
        $days = Day::all();
        $academicPeriods = AcademicPeriod::all();
        return view('dashboard.index', compact('data', 'timetables', 'days', 'academicPeriods'));
    }
}
