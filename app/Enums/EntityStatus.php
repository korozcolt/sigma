<?php

namespace App\Enums;

enum EntityStatus:string
{
    case PENDIENTE = 'pendiente';
    case REVISADO = 'revisado';

    public function pendiente(): bool
    {
        return $this === self::PENDIENTE;
    }
    public function revisado(): bool
    {
        return $this === self::REVISADO;
    }

    public function getLabelText()
    {
        return match ($this) {
            self::PENDIENTE => 'Pendiente',
            self::REVISADO => 'Revisado',
        };
    }

    public function getLabelColor(): string
    {
        return match ($this) {
            self::REVISADO => 'bg-green-600',
            self::PENDIENTE => 'bg-amber-600',
        };
    }

    public function getLabelHTML(): string
    {
        return sprintf('<span class="rounded-md px-2 py-1 text-white %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }
}