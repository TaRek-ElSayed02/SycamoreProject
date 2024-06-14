<?php

namespace App\Listeners;

use App\Events\SensorDataCreated;
use App\Http\Controllers\SensorDataController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakePredictionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SensorDataCreated $event)
    {
        $controller = new SensorDataController(); // Replace with your actual controller name
        $controller->makePrediction($event->sensorData);
    }
}
