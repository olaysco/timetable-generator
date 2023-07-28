<?php

namespace App\Jobs;

use App\Models\Timetable;
use App\Services\GeneticAlgorithm\TimetableGA;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class GenerateTimetables implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $timetable;

    public $timeout = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('Generating timetable');
            $timetableGA = new TimetableGA($this->timetable);
            $timetableGA->run();
            Log::info('Timetable Generated');
        } catch (\Throwable $th) {
            Log::error("Error while generating timetable " . $th->getMessage(), ['trace' => $th->getTrace()]);
        }
    }
}
