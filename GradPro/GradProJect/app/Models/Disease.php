<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = ['disease_name', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
