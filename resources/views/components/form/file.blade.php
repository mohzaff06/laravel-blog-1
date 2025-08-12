@props(['label','name'])
@php
    $default = [
        'class' => "rounded-md px-4 py-2 border-border-primary border-1 w-full h-12",
        'name' => $name,
        'id' => $name,
        'type' => 'file',
        'value' => old($name)
    ]
@endphp

<x-form.field :$label :$name>
    <input {{$attributes->merge($default)}}>
</x-form.field>
