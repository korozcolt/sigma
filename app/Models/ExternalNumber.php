<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExternalNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        "cedula",
        "departamento",
        "municipio",
        "puesto",
        "mesa",
        "direccion",
        "nombre_completo"
    ];

    public function setNombreCompletoAttribute($value): void
    {
        $this->attributes['nombre_completo'] = strtoupper($value);
    }

    public function getNombreCompletoAttribute($value): string
    {
        return strtoupper($value);
    }

    //cedula is related to the voter table on dni column
    public function voter(): BelongsTo
    {
        return $this->belongsTo(Voter::class, 'cedula', 'dni');
    }


}
