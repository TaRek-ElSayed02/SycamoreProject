<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['Description', 'CreatedAt', 'Date', 'Patient_id', 'Doctor_id', 'Patient_Name'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

   

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
