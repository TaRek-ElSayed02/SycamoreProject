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
        'Patient_id',
    ];
    

    public function oxygenGenerator()
    {
        return $this->belongsTo(Oxygen_Generator::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
   
}
