<?php

namespace App\Enums;

enum EntityStatus:string
{
    case PENDIENTE = 'pendiente';
    case REVISADO = 'revisado';
    case VERIFICADO = 'verificado';
    case RECHAZADO = 'rechazado';

    public function pendiente(): bool
    {
        return $this === self::PENDIENTE;
    }
    public function revisado(): bool
    {
        return $this === self::REVISADO;
    }

    public function verificado(): bool
    {
        return $this === self::VERIFICADO;
    }

    public function rechazado(): bool
    {
        return $this === self::RECHAZADO;
    }

    public function getLabelText(): string
    {
        return match ($this) {
            self::PENDIENTE => 'Pendiente',
            self::REVISADO => 'Revisado',
            self::VERIFICADO => 'Verificado',
            self::RECHAZADO => 'Rechazado',
        };
    }

    public function getLabelColor(): string
    {
        return match ($this) {
            self::REVISADO => 'bg-green-600',
            self::PENDIENTE => 'bg-amber-600',
            self::VERIFICADO => 'bg-blue-600',
            self::RECHAZADO => 'bg-red-600',
        };
    }

    public function getLabelHTML(): string
    {
        return sprintf('<span class="rounded-md px-2 py-1 text-white %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }
}
