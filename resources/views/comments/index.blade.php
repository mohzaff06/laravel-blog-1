<div class="mt-8 ">
    @include('comments.create')
    <div id="comments-container" class="flex flex-col gap-5 mt-5 flex-col-reverse">
        @foreach($post->comments as $comment)
            @include('comments.show', $comment)
        @endforeach
    </div>
</div>
