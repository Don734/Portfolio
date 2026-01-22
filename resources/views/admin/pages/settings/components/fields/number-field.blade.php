<label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
<input 
    type="number" 
    class="form-control @if($error) is-invalid @endif" 
    id="{{ $fieldId }}" 
    name="{{ $fieldName }}" 
    value="{{ $value }}"
>