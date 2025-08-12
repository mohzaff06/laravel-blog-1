@props(['_method' => 'POST'])
<form {{$attributes(['class'=>"flex flex-col w-full gap-4 items-center", 'method'=>'GET'])}}>
    @if($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @if($_method !== 'POST')
            @method($_method)
        @endif
    @endif
    {{$slot}}
</form>
