<x-layout>
    <div class="container mx-auto flex flex-col max-w-lg items-center card">
        <x-header-title>Log In</x-header-title>
        <x-form.form action="/login" method="POST">
            <x-form.input name="username" label="Username: "/>
            <x-form.input name="password" label="Password: " type="password"/>
            <span class="">Forget password? <a class="text-text-secondary hover:text-text-primary" href="/forgot-password">Reset Password</a></span>
            <x-button type="submit" value="Log in" tag="input" rounded="4xl"
                      class="h-12 items-center flex w-3xs mt-5"/>
            <span class="">Don't have an account? <a class="text-text-secondary hover:text-text-primary" href="/register">Register here</a></span>
        </x-form.form>
    </div>
</x-layout>

