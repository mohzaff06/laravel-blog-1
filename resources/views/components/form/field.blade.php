@props(['label','name'])

<div class="w-full">
    @if($label)
        <x-form.label :$label :$name/>
    @endif
    <div>
        {{$slot}}
        <x-form.error :error="$errors->first($name)"/>
    </div>
</div>
