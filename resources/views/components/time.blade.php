@props(['object'])
<small class="text-text-secondary flex flex-wrap gap-1 cursor-default">
    @if((time() - $object->created_at->timestamp) < 86401)
        {{$object->created_at->diffForHumans()}}
    @elseif((time() - $object->created_at->timestamp) < 86401*2)
        Yesterday
    @else
        {{$object->created_at->format('Y-m-d')}}
    @endif
    @if($object->created_at != $object->updated_at)
        <span class="text-xs relative group group-hover:cursor-help">
            (edited)
            <span
                class="absolute left-1/2 -translate-x-1/2 bottom-full mb-1 hidden group-hover:block group-active:block bg-text-primary text-bg-primary text-xs px-2 py-1 rounded shadow-medium whitespace-nowrap  z-10">
                Updated at: {{ $object->updated_at->format('Y-m-d H:i') }}
            </span>
        </span>
    @endif
</small>
