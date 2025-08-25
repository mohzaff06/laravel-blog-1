@props(['tag'=>'button','rounded'=>'xl','color'=>'primary'])
@php
    if($color === 'danger'){
        $colors = 'bg-danger/40 border-danger/60 border-2 hover:bg-danger-hover';
    }elseif($color === 'success'){
        $colors = 'bg-success/40 border-success/60 border-2 hover:bg-success-hover';
    }else{
        $colors = 'bg-primary/40 border-primary/60 border-2 hover:bg-primary-hover';
    }
    $classes = 'transition duration-300 cursor-pointer hover:text-bg-secondary text-text-primary px-3 py-1 font-semibold rounded-xl
    ' . $colors;
@endphp
<{{$tag}} {{$attributes->merge(['class'=>$classes])}}>
    {{$slot}}
</{{$tag}}>
