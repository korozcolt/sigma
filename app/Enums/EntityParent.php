<?php

namespace App\Enums;

enum EntityParent:string{
    //if case is null, parent is amigo
    case MADRE = 'madre';
    case PADRE = 'padre';
    case HIJO = 'hijo';
    case HERMANO = 'hermano';
    case TIO = 'tio';
    case ABUELO = 'abuelo';
    case ESPOSO = 'esposo';
    case NOVIO = 'novio';
    case AMIGO = 'amigo';
    case SUEGRO = 'suegro';
    case CUÑADO = 'cuñado';
    case PRIMO = 'primo';
    case YERNO = 'yerno';
    case NUERO = 'nuero';
    case NIETO = 'nieto';
    case SOBRINO = 'sobrino';

    public function getLabelText():string{
        return match($this){
            self::MADRE => 'Madre',
            self::PADRE => 'Padre',
            self::HIJO => 'Hijo',
            self::HERMANO => 'Hermano',
            self::TIO => 'Tío',
            self::ABUELO => 'Abuelo',
            self::ESPOSO => 'Esposo',
            self::NOVIO => 'Novio',
            self::AMIGO => 'Amigo',
            self::SUEGRO => 'Suegro',
            self::CUÑADO => 'Cuñado',
            self::PRIMO => 'Primo',
            self::YERNO => 'Yerno',
            self::NUERO => 'Nuero',
            self::NIETO => 'Nieto',
            self::SOBRINO => 'Sobrino',
        };
    }

    public function getLabelColor():string{
        //if parent is null return self::AMIGO color
        return match($this){
            self::MADRE => 'bg-blue-600',
            self::PADRE => 'bg-blue-500',
            self::HIJO => 'bg-blue-400',
            self::HERMANO => 'bg-blue-300',
            self::TIO => 'bg-blue-200',
            self::ABUELO => 'bg-blue-100',
            self::ESPOSO => 'bg-purple-600',
            self::NOVIO => 'bg-purple-500',
            self::AMIGO => 'bg-purple-400',
            self::SUEGRO => 'bg-purple-300',
            self::CUÑADO => 'bg-purple-200',
            self::PRIMO => 'bg-purple-100',
            self::YERNO => 'bg-purple-600',
            self::NUERO => 'bg-purple-500',
            self::NIETO => 'bg-purple-400',
            self::SOBRINO => 'bg-purple-300',
        };
    }

    //public function get label html
    public function getLabelHTML():string{
        return sprintf('<span class="rounded-md px-2 py-1 text-white %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }
}