<nav class="sticky top-3 left-0 right-0 z-50 mb-12 self-center-safe w-full">
    <div class="mx-4 sm:mx-8 md:mx-16 lg:mx-36">
        <div class="rounded-2xl border border-border-primary
                bg-bg-secondary/50 backdrop-blur-xl backdrop-saturate-150
                shadow-lg shadow-black/5
                py-3 px-4 md:px-8 lg:px-12 grid grid-cols-1 sm:grid-cols-3 gap-4
                text-center sm:text-left items-center font-semibold text-base">

            <!-- Logo -->
            <div class="justify-self-center sm:justify-self-start">
                <a href="/" class="text-2xl text-primary">MohZaff</a>
            </div>

            <!-- Nav Links -->
            <div class="justify-self-center flex justify-center gap-8">
                <a href="/" class="hover:text-primary-hover transition-colors duration-300">Home</a>
                <a href="/about" class="hover:text-primary-hover transition-colors duration-300">About</a>
                <a href="/contact" class="hover:text-primary-hover transition-colors duration-300">Contact</a>
            </div>

            <!-- Auth/User Area -->
            <div class="justify-self-center sm:justify-self-end flex justify-center sm:justify-end gap-4 items-center">
                @guest
                    <a href="/login">Log in</a>
                    <x-button tag="a" href="/register" rounded="full">Sign up</x-button>
                @endguest

                @auth
                    <form action="/logout" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Log out" class="hover:text-primary-hover transition-colors duration-300">
                    </form>
                    <a href="/create" class="hover:text-primary-hover transition-colors duration-300 cursor-default">Create</a>
                @endauth

                <button class="h-9 w-9 transition duration-300 cursor-pointer hover:text-bg-secondary text-text-primary
                bg-primary/40 border-primary/60 border-2 hover:bg-primary-hover
                px-1 py-1 font-semibold rounded-xl
                " id="theme-toggle"><x-icons.dark-theme-svgrepo-com/></button>
            </div>
        </div>
    </div>
</nav>
