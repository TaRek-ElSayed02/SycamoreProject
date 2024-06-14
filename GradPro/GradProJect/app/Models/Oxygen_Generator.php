<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Oxygen_Generator extends Model
{
    use HasFactory;

    protected $fillable = ['Oxygen Level', 'SensorData_id', 'Patient_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function sensorData()
    {
        return $this->hasMany(Sensor_Data::class);
    }
}
