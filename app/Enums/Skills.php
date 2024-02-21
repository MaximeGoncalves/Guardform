<?php

namespace App\Enums;

use PhpParser\Node\Scalar\String_;

enum Skills: int
{
    case EQ_VSAV = 1;
    case EQ_TOUT_ENGIN = 2;
    case COND_VSAV = 3;
    case CHEF_EQUIPE = 4;
    case CA_UNE_EQUIPE = 5;
    case CA_TOUT_ENGIN = 6;
    case VLI = 7;
    case EPA = 8;
    case COD1 = 9;
    case COD2 = 10;

    public function name(): string
    {
        return match ($this) {
            self::EQ_VSAV => 'EQ VSAV',
            self::EQ_TOUT_ENGIN => 'EQ TOUT ENGIN',
            self::COND_VSAV => 'COND VSAV',
            self::CHEF_EQUIPE => 'CHEF D\'EQUIPE',
            self::CA_UNE_EQUIPE => 'CA UNE EQUIPE',
            self::CA_TOUT_ENGIN => 'CA TOUT ENGIN',
            self::VLI => 'VLI',
            self::EPA => 'EPA',
            self::COD1 => 'COD1',
            self::COD2 => 'COD2',
        };
    }
}
