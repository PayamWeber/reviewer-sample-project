<?php

namespace App\Models\Enums;

use Illuminate\Support\Collection;

enum ProductReviewableType: string
{
    case REVIEWABLE_TO_ALL = 'ALL';
    case REVIEWABLE_TO_BUYER_ONLY = 'BUYER_ONLY';

    public static function flattenCases(): array
    {
        $cases = self::cases();

        return collect($cases)->pluck('value')->toArray();
    }
}
