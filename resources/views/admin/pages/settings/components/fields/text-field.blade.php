<label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
<div class="form-floating">
    <input 
        type="text" 
        class="form-control @if($error) is-invalid @endif" 
        id="{{ $fieldId }}" 
        name="{{ $fieldName }}" 
        placeholder="{{ $label }}" 
        value="{{ $value }}"
    >
    <label for="{{ $fieldId }}">{{ $label }}</label>
</div>