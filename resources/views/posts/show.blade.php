<x-layout>
    <div class=" px-10 p-5 "> <!--card bg-bg-secondary rounded-xl border-1 border-border-primary shadow-medium-->
        @if($post->image)
            <div class="rounded-lg"><img src="{{ asset($post->image) }}" class="w-full rounded-4xl border-primary border-3" alt=""></div> <!-- 500/270 -->
        @endif
        <div class="flex flex-wrap-reverse gap-3 items-center justify-between mt-4">
            <div class="mb flex flex-wrap items-end gap-2">
                <h1 class="text-2xl font-semibold">{{$post->title}}</h1>
                <x-time :object="$post"/>
            </div>
            <div class="flex gap-2">
                @can('update', $post)
                    <x-button tag='a' href='/post/{{$post->id}}/edit' class="text-bg-primary">Edit</x-button>
                @endcan
                @can('delete', $post)
                    <x-button tag='input' form='delete-form' type='submit' id="delete-post" color="danger"
                              value="Delete"/>
                @endcan
            </div>
        </div>
        <p class="mb-4">By <span class="font-semibold text-primary">{{$post->user->username}}</span></p>
        <div class="mb-4 text-lg">
            {!! $post->body !!}
        </div>
    </div>
    @can('delete', $post)
        <x-form.form id="delete-form" class="hidden" action="/post/{{$post->id}}" method="POST" _method="DELETE">
        </x-form.form>
    @endcan

    @include('comments.index', ['comments' => $post->comments])
</x-layout>
