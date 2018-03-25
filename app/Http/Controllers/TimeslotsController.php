<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Services\TimeslotsService;

use App\Models\Day;
use App\Models\Timeslot;

class TimeslotsController extends Controller
{
    /**
     * Service class for timeslot related operations
     *
     * @var App\Services\TimeslotService $service
     */
    protected $service;

    /**
     * Create a new instance of this controller
     *
     * @param App\Services\TimeslotsService $service
     */
    public function __construct(TimeslotsService $service)
    {
        $this->service = $service;
    }

    /**
     * Get a listing of timeslots
     *
     * @param Illuminate\Http\Request $request The HTTP request
     */
    public function index(Request $request)
    {
        $timeslots = $this->service->all();

        if ($request->ajax()) {
            return view('timeslots.table', compact('timeslots'));
        }

        return view('timeslots.index', compact('timeslots'));
    }

    /**
     * Add a new timeslot
     *
     * @param Illuminate\Http\Request $request The HTTP request
     */
    public function store(Request $request)
    {
        $rules = [
            'from' => 'required|before:to',
            'to' => 'required|after:from'
        ];

        $messages = [
            'from.before' => 'From time must be before To time',
            'to.after' => 'To time must be after From time'
        ];

        $this->validate($request, $rules, $messages);

        $exists = Timeslot::where('time', Timeslot::createTimePeriod($request->from, $request->to))->first();

        if ($exists) {
            return Response::json(['errors' => ['This timeslot already exists']], 422);
        }

        $data = $request->all();
        $data['time'] = Timeslot::createTimePeriod($data['from'], $data['to']);

        $timeslot = $this->service->store($data);

        if ($timeslot) {
            return Response::json(['message' => 'Timeslot has been added'], 200);
        } else {
            return Response::json(['error' => 'A system error occurred'], 500);
        }
    }

    /**
     * Get the timeslot with the given ID
     *
     * @param int $id The timeslot id
     */
    public function show($id)
    {
        $timeslot = Timeslot::find($id);

        if ($timeslot) {
            $timeParts = explode("-", $timeslot->time);
            $timeslot->from = $timeParts[0];
            $timeslot->to = $timeParts[1];

            return Response::json($timeslot, 200);
        } else {
            return Response::json(['error' => 'Timeslot not found'], 404);
        }
    }
}
