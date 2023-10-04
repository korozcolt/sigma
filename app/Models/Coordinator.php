<?php

namespace App\Models;

use App\Enums\EntityStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        ])->onDelete('cascade')->onUpdate('cascade');
    }

    public function place(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function leaders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Leader::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    //define a mutator to set the first name to uppercase and trim the spaces before and after the name
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

    protected $casts = [
        'status' => EntityStatus::class
    ];
}
