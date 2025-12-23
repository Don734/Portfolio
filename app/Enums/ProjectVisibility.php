<?php

namespace App\Enums;

enum ProjectVisibility: string
{
    case Public = 'public';
    case Private = 'private';
    case Unlisted = 'unlisted';

    public function label(): string
    {
        return trans()->has('enums.project_visibility.' . $this->value)
            ? __('enums.project_visibility.' . $this->value)
            : ucfirst($this->value);
    }

    public function icon(): string 
    {
        return match ($this) {
            self::Public => 'eye',
            self::Private => 'lock',
            self::Unlisted => 'link',
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
