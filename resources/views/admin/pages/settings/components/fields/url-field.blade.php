<label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
<input 
    type="url" 
    class="form-control @if($error) is-invalid @endif" 
    id="{{ $fieldId }}" 
    name="{{ $fieldName }}" 
    value="{{ $value }}"
    placeholder="https://example.com"
>