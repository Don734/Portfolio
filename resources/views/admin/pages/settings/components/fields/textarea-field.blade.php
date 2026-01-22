<label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
<div class="form-floating">
    <textarea class="form-control @if($error) is-invalid @endif"
        id="{{ $fieldId }}" 
        name="{{ $fieldName }}" 
        style="height: 150px">{{ $value }}</textarea>
    <label for="{{ $fieldId }}">{{ $label }}</label>
</div>