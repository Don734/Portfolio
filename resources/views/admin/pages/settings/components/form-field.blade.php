@php
    $fieldName = "{$group}[{$key}]";
    $fieldId = "setting_{$key}";
    $value = old("{$group}.{$key}", $setting->value ?? '');
    $label = $definition['label'] ?? ucfirst(str_replace('_', ' ', $key));
    $help = $definition['help'] ?? null;
    $type = $setting->type ?? 'string';
    $error = $errors->first("{$group}.{$key}");
@endphp

<div class="mb-4">
    @switch($type)
        @case('string')
            @include('admin.pages.settings.components.fields.text-field')
            @break

        @case('email')
            @include('admin.pages.settings.components.fields.email-field')
            @break

        @case('url')
            @include('admin.pages.settings.components.fields.url-field')
            @break

        @case('text')
            @include('admin.pages.settings.components.fields.textarea-field')
            @break

        @case('boolean')
            @include('admin.pages.settings.components.fields.checkbox-field')
            @break

        @case('integer')
            @include('admin.pages.settings.components.fields.number-field')
            @break

        @default
            @include('admin.pages.settings.components.fields.text-field')
    @endswitch

    @if($help)
        <small class="form-text text-muted d-block mt-2">
            <i class="fas fa-info-circle me-1"></i>
            {{ $help }}
        </small>
    @endif

    @if($error)
        <div class="invalid-feedback d-block">
            {{ $error }}
        </div>
    @endif
</div>