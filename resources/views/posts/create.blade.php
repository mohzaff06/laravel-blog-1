<x-layout>
    <div class="container mx-auto flex flex-col max-w-4xl items-center card">
        <x-header-title>Create Post</x-header-title>
        <x-form.form action="/create" method="POST" enctype="multipart/form-data">
            <x-form.input name="title" label="Title: "/>
            <x-form.textarea name="body" label="Body: ">{{old('body')}}</x-form.textarea>
            <x-form.file name="image" label="Image (optional):"/>
            <x-form.input name="tags" label="Tags (Separated by comma ,): "/>
            <x-form.select :options="$categories" name="category_id" label="Choose Category: "/>

            <x-button type="submit" value="Post" tag="input" class="h-12 items-center flex w-3xs mt-10"/>
        </x-form.form>
    </div>
</x-layout>
