<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Services\ProfessorsService;

use App\Models\Day;
use App\Models\Course;
use App\Models\Timeslot;
use App\Models\Professor;
use App\Models\UnavailableTimeslot;

class ProfessorsController extends Controller
{
    /**
     * Service class for handling operations relating to this
     * controller
     *
     * @var App\Services\ProfessorsService $service
     */
    protected $service;

    /**
     * Create a new instance of this controller
     *
     * @param App\Services\ProfessorsService $service This controller's service class
     */
    public function __construct(ProfessorsService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
        $this->middleware('activated');
    }

    /**
     * Show landing page for professors module
     *
     * @param Illuminate\Http\Request $request The HTTP request
     */
    public function index(Request $request)
    {
        $professors = $this->service->all([
            'order_by' => 'name',
            'paginate' => 'true',
            'per_page' => 20
        ]);

        $courses = Course::all();
        $days = Day::all();
        $timeslots = Timeslot::all();

        if ($request->ajax()) {
            return view('professors.table', compact('professors'));
        }

        return view('professors.index', compact('professors', 'courses', 'days', 'timeslots'));
    }

    /**
     * Add a new professor to the database
     *
     * @param Illuminate\Http\Request The HTTP request
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $this->validate($request, $rules);

        $professor = $this->service->store($request->all());

        if ($professor) {
            return Response::json(['message' => 'Professor added'], 200);
        } else {
            return Response::json(['error' => 'An unknown system error occurred'], 500);
        }
    }
}
