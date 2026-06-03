<?php

namespace App\Enum;

enum TipoProveedor: string
{
    case Hotel = 'hotel';
    case Crucero = 'crucero';
    case EstacionEsqui = 'estacion_esqui';
    case ParqueTematico = 'parque_tematico';

    //texto legible para mostrar el enum
    public function label(): string
    {
        return match ($this) {
            self::Hotel => 'Hotel',
            self::Crucero => 'Crucero',
            self::EstacionEsqui => 'Estación de esquí',
            self::ParqueTematico => 'Parque temático',
        };
    }
}
