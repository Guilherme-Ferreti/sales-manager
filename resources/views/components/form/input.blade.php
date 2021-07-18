@props([
    'errorKey' => $attributes['errorKey'] ?? $attributes['name'],
    'icon' => false
])

<input {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($errorKey)]) }} />

@if ($icon)
<div class="input-group-append">
    <div class="input-group-text" role="button">
        <span class="fas {{ $icon }}"></span>
    </div>
</div>
@endif

<span 
    class="
        error 
        invalid-feedback 
        @if (!$errors->has($errorKey)) {{ 'd-none' }} @endif
        "
    id="{{ $attributes['id'] }}-error-message">
    {{ $errors->first($errorKey) }}
</span>