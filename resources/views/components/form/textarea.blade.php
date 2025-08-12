@props(['label','name','height'=>'50'])
@php
    $default = [
        'class' => "rounded-md px-4 py-2 border-border-primary border-1 w-full h-" . $height,
        'name' => $name,
        'id' => $name,

    ]
@endphp

<x-form.field :$label :$name>
    <textarea {{$attributes->merge($default)}}>{{$slot}}</textarea>
</x-form.field>
