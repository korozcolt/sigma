<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'zona',
        'puesto',
        'mesa',
        'nombre_puesto',
        'municipio',
        'type'
    ];


}
