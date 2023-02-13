<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'place',
        'table',
    ];

    public function coordinators()
    {
        return $this->hasMany(Coordinator::class);
    }

    public function leaders()
    {
        return $this->hasManyThrough(Leader::class, Coordinator::class);
    }

    public function voters()
    {
        return $this->hasManyThrough(Voter::class, Leader::class);
    }

    public function setPlaceAttribute($value)
    {
        $this->attributes['place'] = strtoupper($value);
    }

}