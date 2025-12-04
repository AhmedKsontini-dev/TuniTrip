<?php

namespace App\Enum;

enum TransferType: string
{
    case ONE_WAY = 'one_way';
    case RETURN = 'return';

    public function label(): string
    {
        return match ($this) {
            self::ONE_WAY => 'One Way',
            self::RETURN => 'Return (new ride)',
        };
    }
}
