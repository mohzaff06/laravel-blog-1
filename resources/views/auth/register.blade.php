<x-layout>
    <div class="container mx-auto flex flex-col max-w-lg items-center card">
        <x-header-title>Sign Up</x-header-title>
        <x-form.form action="/register" method="POST">
            <x-form.input name="username" label="Username: "/>
            <x-form.input name="email" label="Email: " type="email"/>
            <x-form.input name="password" label="Password: " type="password"/>
            <x-form.input name="password_confirmation" label="Confirm Password: " type="password"/>

            <x-button type="submit" value="Sign up" tag="input" rounded="4xl"
                      class="h-12 items-center flex w-3xs mt-5"/>
            <span class="left">Do you already have an account? <a href="/login" class="text-text-secondary hover:text-text-primary">Login here</a></span>
        </x-form.form>
    </div>
</x-layout>
