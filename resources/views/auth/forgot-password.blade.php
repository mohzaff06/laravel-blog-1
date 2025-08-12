<x-layout>
    <div class="container mx-auto flex flex-col max-w-lg items-center card">
        <x-header-title>Reset Password</x-header-title>
        <x-form.form action="/reset-password" method="POST">
            <x-form.input name="email" label="Email: "/>
            <x-button type="submit" value="Send Email" tag="input" rounded="4xl"
                      class="h-12 items-center flex w-3xs mt-5"/>
            <span class="">Don't have an account? <a class="text-text-secondary hover:text-text-primary" href="/register">Register here</a></span>
        </x-form.form>
    </div>
</x-layout>

