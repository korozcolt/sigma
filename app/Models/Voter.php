<?php

namespace App\Models;

use App\Enums\EntityStatus;
use App\Enums\EntityParent;
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
        'entity_parent',
    ];

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

    public function leader()
    {
        return $this->belongsTo(Leader::class);
    }

    //One leader can have one Coordinador, on voter can have one leader and one coordinador but voter only has a realtionship with one leader
    public function coordinador()
    {
        return $this->belongsTo(Leader::class, 'leader_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    protected $casts = [
        'status' => EntityStatus::class,
        'entity_parent' => EntityParent::class
    ];
}