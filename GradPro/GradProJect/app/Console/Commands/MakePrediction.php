<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SensorDataController;
class MakePrediction extends Command
{
    protected $signature = 'make:prediction';
    protected $description = 'Make prediction and store in database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new SensorDataController(); // Replace with your actual controller name
        $controller->makePrediction();
        $this->info('Prediction made and stored successfully.');
    }
}
