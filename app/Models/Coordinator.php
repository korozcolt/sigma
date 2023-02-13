<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'first_name',
        'last_name',
        'phone',
        'address',
        'type',
        'status',
        'debate_boss',
        'candidate',
        'place_id',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function leaders()
    {
        return $this->hasMany(Leader::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = trim(strtoupper($value));
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = trim(strtoupper($value));
    }
}