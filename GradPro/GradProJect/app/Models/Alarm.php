<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alarm extends Model
{
    use HasFactory;
    protected $fillable = ['Message', 'Time'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
