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
        return $this->hasMany(Leader::class);
    }

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }

    public function setPlaceAttribute($value)
    {
        $this->attributes['place'] = trim(strtoupper($value));
    }

    //function for convert the place to uppercase
    public function getPlaceAttribute($value)
    {
        return strtoupper($value);
    }
}
