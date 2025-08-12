@props(['error'=>false])

@if($error)
    <p class="text-sm text-red-600 text-italic mt-1">
        {{ $error }}
    </p>
@endif
