<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum EnrollmentStatus: string implements HasLabel, HasColor, HasIcon
{
    case Pending = 'Pending';
    case Active = 'Active';
    case Completed = 'Completed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Active => 'Active',
            self::Completed => 'Completed',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'yellow',
            self::Active => 'primary',
            self::Completed => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Pending => 'heroicon-m-clock',
            self::Active => 'heroicon-m-play',
            self::Completed => 'heroicon-m-check-circle',
        };
    }
}
