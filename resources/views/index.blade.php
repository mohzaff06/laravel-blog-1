<x-layout>
    <x-hero></x-hero>

    <div class="">
        <section class=" flex flex-wrap gap-4 text-text-primary border-b border-b-border-primary text-base">
            <x-filter-link  id="all-posts-btn">View all</x-filter-link>
            @foreach($categories as $category)
                <x-filter-link data-category-id="{{$category->id}}">{{$category->name}}</x-filter-link>
            @endforeach
        </section>

        <section id='posts-container' class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-10 mt-5 ">

        </section>

        <div class="mt-25 flex justify-center ">
            <x-button>Load More</x-button>
        </div>
    </div>
</x-layout>
