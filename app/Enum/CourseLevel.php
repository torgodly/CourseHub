<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CourseLevel: string implements HasLabel, HasColor, HasIcon
{
    case Beginner = 'beginner';
    case Intermediate = 'intermediate';
    case Advanced = 'advanced';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Beginner => __('Beginner'),
            self::Intermediate => __('Intermediate'),
            self::Advanced => __('Advanced'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Beginner => 'info',
            self::Intermediate => 'warning',
            self::Advanced => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Beginner => 'heroicon-m-sparkles',
            self::Intermediate => 'heroicon-m-light-bulb',
            self::Advanced => 'heroicon-m-fire',
        };
    }
}
