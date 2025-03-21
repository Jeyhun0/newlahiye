<?php

namespace App\Enums;

enum TaxType: int
{
    case EXCLUSIVE = 0;
    case INCLUSIVE = 1;

    public function label(): string
    {
        return match ($this) {
            self::EXCLUSIVE => __('var'),
            self::INCLUSIVE => __('yox'),
        };
    }
}
