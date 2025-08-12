@props(['tag'=>'button','rounded'=>'xl','color'=>'primary'])
@php
    if($color === 'danger'){
        $colors = 'bg-danger hover:bg-danger-hover';
    }elseif($color === 'success'){
        $colors = 'bg-success hover:bg-success-hover';
    }else{
        $colors = 'bg-primary hover:bg-primary-hover';
    }
    $classes = 'transition duration-300 cursor-pointer text-bg-primary px-3 py-1 font-semibold rounded-2xl
    ' . $colors;
@endphp
<{{$tag}} {{$attributes->merge(['class'=>$classes])}}>
    {{$slot}}
</{{$tag}}>
