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

    public function coordinators(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Coordinator::class);
    }

    public function leaders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Leader::class);
    }

    public function voters(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Voter::class);
    }

    public function setPlaceAttribute($value): void
    {
        $this->attributes['place'] = trim(strtoupper($value));
    }

    //function for convert the place to uppercase
    public function getPlaceAttribute($value): string
    {
        return strtoupper($value);
    }
}
