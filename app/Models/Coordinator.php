<?php

namespace App\Models;

use App\Enums\EntityStatus;
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
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class)->withDefault([
            'name' => $this->full_name,
            'email' => $this->dni . '@sigma.com',
            'role' => 'coordinator',
        ])->onDelete('cascade');
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function leaders()
    {
        return $this->hasMany(Leader::class);
    }

    public function users()
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

    protected $casts = [
        'status' => EntityStatus::class
    ];
}
