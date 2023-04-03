<?php

namespace App\Models;

use App\Enums\EntityStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
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
        'coordinator_id',
        'place_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }

    //define a mutator to set the last name to uppercase and trim the spaces before and after the name
    protected function lastName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }

    //define a mutator to get the full name concatenating the first name and the last name
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class);
    }

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    protected $casts = [
        'status' => EntityStatus::class
    ];
}