<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'status',
        'type',
        'debate_boss',
        'candidate',
        'coordinator_id',
        'place_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class);
    }

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }
}