<div class="form-check">
    <input 
        type="checkbox" 
        class="form-check-input @if($error) is-invalid @endif" 
        id="{{ $fieldId }}" 
        name="{{ $fieldName }}" 
        value="1"
        @if($value) checked @endif
    >
    <label class="form-check-label" for="{{ $fieldId }}">
        {{ $label }}
    </label>
</div>