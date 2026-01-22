<label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
<textarea 
    class="form-control @if($error) is-invalid @endif" 
    id="{{ $fieldId }}" 
    name="{{ $fieldName }}" 
    rows="4"
>{{ $value }}</textarea>