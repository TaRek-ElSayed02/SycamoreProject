<?php

namespace App\Models;

use App\Http\Controllers\SensorDataController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sensor_Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'oxygen_rate',
        'heart_rate',
        'clieus',
        'prediction',
    ];
    

    public function oxygenGenerator()
    {
        return $this->belongsTo(Oxygen_Generator::class);
    }
    protected static function booted()
    {
        static::created(function ($sensorData) {
            $controller = new SensorDataController(); // Replace with your actual controller name
            $controller->makePrediction();
        });
    }
}
