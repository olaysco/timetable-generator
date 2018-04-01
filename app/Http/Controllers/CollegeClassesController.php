<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CollegeClassesService;

use App\Models\Course;
use App\Models\Room;

class CollegeClassesController extends Controller
{
    /**
     * Service class for handling operations relating to this
     * controller
     *
     * @var App\Services\CollegeClassesService $service
     */
    protected $service;

    public function __construct(CollegeClassesService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
        $this->middleware('activated');
    }

    /**
     * Get a listing of college classes
     *
     * @param Illuminate\Http\Request $request The HTTP request
     * @param Illuminate\Http\Response The HTTP response
     */
    public function index(Request $request)
    {
        $classes = $this->service->all([
            'order_by' => 'name',
            'paginate' => 'true',
            'per_page' => 20
        ]);

        $rooms = Room::all();
        $courses = Course::all();

        if ($request->ajax()) {
            return view('classes.table', compact('classes'));
        }

        return view('classes.index', compact('classes', 'rooms', 'courses'));
    }
}
