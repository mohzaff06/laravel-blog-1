<x-layout>
    <div class="container mx-auto flex flex-col max-w-4xl items-center card">
        <x-header-title>Edit Post</x-header-title>
        <x-form.form action="/post/{{$post->id}}" method='POST' _method="PUT" enctype="multipart/form-data">
            <x-form.input name="title" label="Title: " value="{{$post->title}}"/>
            <x-form.textarea name="body" label="Body: ">{{$post->body}}</x-form.textarea>
            <x-form.file name="image" label="Image (optional):"/>
            <x-form.input name="tags" label="Tags (Separated by comma ,): "
                          value="{{$post->tags->pluck('name')->implode(', ')}}"/>
            <x-form.select :options="$categories" selected='{{$post->category->id}}' name="category_id"
                           label="Category:"/>

            <x-button type="submit" value="Update" tag="input" class="h-12 items-center flex w-3xs mt-10"/>
        </x-form.form>
    </div>
</x-layout>
