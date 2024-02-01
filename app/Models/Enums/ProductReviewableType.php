<?php

namespace App\Models\Enums;

enum ProductReviewableType: string
{
    case REVIEWABLE_TO_ALL = 'ALL';
    case REVIEWABLE_TO_BUYER_ONLY = 'BUYER_ONLY';

    public static function caseValues(): array
    {
        $cases = self::cases();

        return collect($cases)->pluck('value')->toArray();
    }
}
