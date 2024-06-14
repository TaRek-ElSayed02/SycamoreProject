<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['disease_id', 'disease_question'];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
}
