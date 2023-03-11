<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'status',
        'type',
        'debate_boss',
        'candidate',
        'leader_id',
        'place_id',
    ];

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

    public function leader()
    {
        return $this->belongsTo(Leader::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
