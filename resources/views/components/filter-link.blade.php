@props(['active'=>false])
@php
    $classes='category-btn-inactive cursor-pointer category-btn';
    if($active){
        $classes='category-btn-active category-btn';
    }

@endphp

<button {{$attributes->merge(['class'=>$classes])}}>{{$slot}}</button>
