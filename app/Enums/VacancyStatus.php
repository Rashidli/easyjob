<?php

namespace App\Enums;

enum VacancyStatus: string
{
    case UnderReview = 'review';  // Yoxlamada
    case Published   = 'published';    // Dərc edilib
    case Returned    = 'returned';     // Geri qaytarılıb
    case Cancelled   = 'cancelled';    // Imtina edilib

    public function label(): string
    {
        return match ($this) {
            self::UnderReview => 'Yoxlamada',
            self::Published   => 'Dərc edilib',
            self::Returned    => 'Geri qaytarılıb',
            self::Cancelled   => 'Imtina edilib',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::UnderReview => 'background-color: yellow; color: black;',  // Yellow for under review
            self::Published   => 'background-color: green; color: white;',    // Green for published
            self::Returned    => 'background-color: blue; color: white;',      // Blue for returned
            self::Cancelled   => 'background-color: red; color: white;',      // Red for cancelled
        };
    }
}
