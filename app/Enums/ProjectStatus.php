<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case Archived = 'archived';


    public function label(): string
    {
        return trans()->has('enums.project_status.' . $this->value)
            ? __('enums.project_status.' . $this->value)
            : ucfirst($this->value);
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Active => 'green',
            self::Archived => 'red',
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
