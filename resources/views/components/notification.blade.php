@if (session('success') || session('error') || session('warning') || session('info'))
    <div
        class="fixed inset-0 text-sm z-50 flex justify-center items-end mb-6 pointer-events-none "
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition
    >
        <div class="px-6 py-3 rounded-full shadow-lg  pointer-events-auto
                    @if(session('success')) bg-success text-bg-primary
                    @elseif(session('error')) bg-danger text-bg-primary
                    @elseif(session('warning')) bg-warning text-black
                    @elseif(session('info')) bg-primary text-bg-primary
                    @endif">
            {{ session('success') ?? session('error') ?? session('warning') ?? session('info')}}
        </div>
    </div>
@endif
