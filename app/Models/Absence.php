<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'temperature',
        'image',
        'presence_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPresenceDateAttribute()
    {
        return Carbon::parse($this->attributes['presence_date'])->translatedFormat('l, d F Y');
    }
}
