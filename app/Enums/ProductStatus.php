<?php

namespace App\Enums;

enum ProductStatus: string
{
    case NOSTOCK = 'out-of-stock';
    case INSTOCK = 'in-stock';
    case ONHOLD = 'on-hold';

    public function getReadableStatus()
    {
        return match ($this) {
            ProductStatus::INSTOCK => 'Is in Stock',
            ProductStatus::NOSTOCK => 'Is out of stock',
            ProductStatus::ONHOLD  => 'Is on hold',
        };
    }
}
