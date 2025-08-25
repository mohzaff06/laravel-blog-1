<x-layout>
    <div class="h-[100%] grow flex items-center justify-center">
        <div class="container mx-auto flex flex-col max-w-lg items-center card p-6">
            <x-header-title>Verify Email</x-header-title>
            <x-form.form action="/email/verification-notification" method="POST" class="w-full flex flex-col items-center">
                <span class="text-center">
                    Thanks for signing up! Before getting started, please verify your email
                    address by clicking the link we sent you.
                </span>
                <x-button type="submit" value="Resend" tag="input" rounded="4xl"
                          class="h-12 items-center flex w-3xs mt-5"/>
            </x-form.form>
        </div>
    </div>
</x-layout>

