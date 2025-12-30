<?php

namespace App\Enums;

enum ProjectType: string
{
    case Website = 'website';
    case WebApp = 'web_app';
    case Game = 'game';
    case Other = 'other';
    
    public function label(): string
    {
        return trans()->has('enums.project_type.' . $this->value)
            ? __('enums.project_type.' . $this->value)
            : ucfirst($this->value);
    }

    public function color(): string
    {
        return match ($this) {
            self::Website => 'primary',
            self::WebApp => 'info',
            self::Game => 'danger',
            self::Other => 'secondary',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn ($case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }
}
