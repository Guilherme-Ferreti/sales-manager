@props(['errorKey' => $attributes['errorKey'] ?? $attributes['name']])

<select {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($errorKey)]) }}>
    {{ $slot }}
</select>

@if ($errors->has($errorKey))
    <span class="error invalid-feedback">{{ $errors->first($errorKey) }}</span>
@endif