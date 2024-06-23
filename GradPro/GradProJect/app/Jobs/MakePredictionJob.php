<?php

namespace App\Jobs;

use App\Models\Sensor_Data;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class MakePredictionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct(Sensor_Data $data)
    {
         $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Log the data retrieved from the database
        Log::info('Latest sensor data: ', $this->data->toArray());

        // Prepare the data to send to the Flask API
        $parameters = [
            'oxy' => $this->data->oxygen_rate,
            'pulse' => $this->data->heart_rate,
            'clieus' => $this->data->clieus,
        ];

        // Make a POST request to the Flask API
        $response = Http::post('http://127.0.0.1:8080/predict', $parameters);

        if ($response->successful()) {
            $prediction = $response->json()['prediction'];

            // Save the prediction back to the database
            $this->data->prediction = $prediction;
            $this->data->save();
        } else {
            Log::error('Prediction API failed');
        }
    }
}
