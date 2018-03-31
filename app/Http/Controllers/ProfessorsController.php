<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Timeslot;
use App\Models\Professor;

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

        if ($request->ajax()) {
            return view('professors.table', compact('professors'));
        }

        return view('professors.index', compact('professors'));
    }
}
