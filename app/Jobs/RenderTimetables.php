<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\GeneticAlgorithm\TimetableRenderer;

class RenderTimetables implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $timetable;

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
        $renderer = new TimetableRenderer($this->timetable);
        $renderer->render();
    }
}
