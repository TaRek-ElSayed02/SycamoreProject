<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User;
    

use Illuminate\Foundation\Auth\User as Authenticatable;
class Doctor extends Model
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    protected $table = 'doctors';

    protected $fillable = ['NewPassword', 'Email', 'Password', 'Password_Confirmation','Name'];

    public function alarms()
    {
        return $this->hasMany(Alarm::class);
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
