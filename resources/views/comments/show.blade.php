
<div class="p-4 border-b border-border-primary" data-comment-id="{{$comment->id}}">
    <div class="flex flex-wrap-reverse gap-3 items-center justify-between mb-4">
        <div class="flex flex-wrap items-end gap-2 mb-2">
            <p class="font-bold">By <span class="text-primary">{{$comment->user->username}}</span></p>
            <x-time :object="$comment"/>
        </div>
        <div class="comment-btns flex gap-2">
            @can('update', $comment)
                <x-button class="edit-comment-btn"  data-comment-id="{{$comment->id}}">
                    Edit
                </x-button>
            @endcan
            @can('delete', $comment)
                <x-button class="delete-comment-btn" data-comment-id="{{$comment->id}}" color="danger">
                    Delete
                </x-button>
            @endcan
        </div>
    </div>


    <p class="comment-body text-lg ">{{$comment->body}}</p>

</div>

<!--
<div class="flex gap-4 justify-around items-center md:flex-nowrap flex-wrap">
        <x-form.input height='12' class='update-comment-input' name="comment" label="" placeholder="Edit Comment"/>

        <x-button  class="update-comment-btn h-8 items-center flex w-[5rem]">Update</x-button>
        <x-button color="danger" class="cancel-comment-btn h-8 items-center flex w-[5rem]">Cancel</x-button>
    </div>
-->

