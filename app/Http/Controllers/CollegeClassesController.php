<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Services\CollegeClassesService;

use App\Models\Room;
use App\Models\Course;
use App\Models\CollegeClass;
use App\Models\AcademicPeriod;

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
            'keyword' => $request->has('keyword') ? $request->keyword : null,
            'filter' => $request->has('filter') ? $request->filter : null,
            'order_by' => 'name',
            'paginate' => 'true',
            'per_page' => 20
        ]);

        $rooms = Room::all();
        $courses = Course::all();
        $academicPeriods = AcademicPeriod::all();


        if ($request->ajax()) {
            return view('classes.table', compact('classes', 'academicPeriods'));
        }

        return view('classes.index', compact('classes', 'rooms', 'courses', 'academicPeriods'));
    }

    /**
     * Add a new class to the database
     *
     * @param Illuminate\Http\Request $request The HTTP request
     * @param Illuminate\Http\Response A JSON response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:classes',
            'size' => 'required'
        ];

        $this->validate($request, $rules);

        $class = $this->service->store($request->all());

        if ($class) {
            return Response::json(['message' => 'Class added'], 200);
        } else {
            return Response::json(['error' => 'A system error occurred'], 500);
        }
    }

    /**
     * Get the class with the given ID
     *
     * @param int $id The id of the class
     * @return Illuminate\Http\Response A JSON response
     */
    public function show($id)
    {
        $class = $this->service->show($id);

        if ($class) {
            return Response::json($class, 200);
        } else {
            return Response::json(['error' => 'Class not found'], 404);
        }
    }

    /**
     * Update the class whose id is given
     *
     * @param int $id Id of class
     * @param Illuminate\Http\Request $request The HTTP request
     * @return Illuminate\Http\Response The HTTP response
     */
    public function update($id, Request $request)
    {
        $rules = [
            'name' => 'required|unique:classes,name,' . $id,
            'size' => 'required'
        ];

        $this->validate($request, $rules);

        $class = CollegeClass::find($id);

        if (!$class) {
            return Response::json(['error' => 'Class not found'], 404);
        }

        $class = $this->service->update($id, $request->all());

        return Response::json(['message' => 'Class updated'], 200);
    }

    /**
     * Delete the college class with the given ID
     *
     * @param int $id The ID of the college class
     * @return Illuminate\Http\Response A JSON response
     */
    public function destroy($id)
    {
        $class = CollegeClass::find($id);

        if (!$class) {
            return Response::json(['error' => 'Class not found'], 404);
        }

        if ($this->service->delete($id)) {
            return Response::json(['message' => 'Class has been deleted'], 200);
        } else {
            return Response::json(['error' => 'An unknown system error occurred'], 500);
        }
    }
}
