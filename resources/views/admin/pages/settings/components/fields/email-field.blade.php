<label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
<input 
    type="email" 
    class="form-control @if($error) is-invalid @endif" 
    id="{{ $fieldId }}" 
    name="{{ $fieldName }}" 
    value="{{ $value }}"
    required
>