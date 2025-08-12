<artical class="group transition-all duration-350 hover:scale-105 cursor-pointer ">
    <a href="/post/{{$post->id}}">
        <div class="w-full">
            @if($post->image)
                <img src="{{ $post->image }}" class="w-full aspect-[500/270]" alt="">
            @else
                <x-post-image-holder label="No Image Available"/>
            @endif
        </div>
        <div class="mt-7 mr-4">
            <a class="font-bold text-2xl group-hover:underline underline-offset-2 transition-all duration-500">
                {{substr($post->title,0,40)}} @if(strlen($post->title)>40) ..... @endif
            </a>
            <p class="text-text-primary">
                {{substr($post->body,0,150)}} @if(strlen($post->body)>150) ..... @endif
            </p>
        </div>
        <div class="mt-5 font-bold">
            <button class="flex items-center text-primary cursor-pointer">
                Read post
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </button>
        </div>
    </a>
</artical>
