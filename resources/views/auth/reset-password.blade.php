<x-layout>
    <div class="container mx-auto flex flex-col max-w-lg items-center card">
        <x-header-title>Reset password</x-header-title>
        <x-form.form action="/reset-password" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <x-form.input name="password" label="Password: " type="password"/>
            <x-form.input name="password_confirmation" label="Confirm Password: " type="password"/>

            <x-button type="submit" value="Reset" tag="input" rounded="4xl"
                      class="h-12 items-center flex w-3xs mt-5"/>
        </x-form.form>
    </div>
</x-layout>
