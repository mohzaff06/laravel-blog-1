<div class="container mx-auto mb-8">
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex gap-4 justify-around md:flex-nowrap flex-wrap">
        <x-form.input height='12' id='comment-input' name="comment" label="" placeholder="Comment"/>

        <x-button type="submit" id="create-comment-btn" value="Comment" tag="input" class="h-12 items-center flex w-3xs"/>
        </div>
    </form>
</div>
