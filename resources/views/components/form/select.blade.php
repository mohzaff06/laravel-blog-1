@props(['label','name','options','selected' => false])
@php
    $default = [
        'class' => "rounded-md px-4 py-2 border-border-primary border-1 w-full h-12",
        'name' => $name,
        'id' => $name,
        'value' => old($name)
    ]
@endphp

<x-form.field :$label :$name>
    <select {{$attributes->merge($default)}}>
        @if(!$selected)
            <option value="" disabled selected>Choose Category: </option>
        @endif
        @foreach($options as $option)
            <option value="{{$option->id}}" @if($selected === $option->id) selected @endif>
                {{$option->name}}
            </option>
        @endforeach
    </select>
</x-form.field>
