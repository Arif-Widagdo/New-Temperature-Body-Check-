<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Position;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $incrementing = false;
    protected $fillable = [
        'id',
        'id_position',
        'name',
        'email',
        'password',
        'address',
        'telp',
        'picture',
        'gender',
        'status',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position');
    }

    public function absence()
    {
        return $this->hasMany(Absence::class);
    }

    public function getPictureAttribute($value)
    {
        if ($value) {
            return asset('storage/img/users/' . $value);
        } else {
            return asset('dist/img/users/no-image.jpeg');
        }
    }
}
