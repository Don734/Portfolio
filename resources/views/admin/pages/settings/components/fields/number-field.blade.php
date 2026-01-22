
<label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
<div class="form-floating">
    <input 
        type="number" 
        class="form-control @if($error) is-invalid @endif" 
        id="{{ $fieldId }}" 
        name="{{ $fieldName }}" 
        placeholder="{{ $label }}" 
        value="{{ $value }}"
        required
    >
    <label for="{{ $fieldId }}">{{ $label }}</label>
</div>