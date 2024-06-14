<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['qustions_id', 'patient_id', 'ques_value'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
