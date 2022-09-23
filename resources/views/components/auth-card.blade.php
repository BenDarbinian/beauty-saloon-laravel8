<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="transition ease in out hover:scale-110 duration-100">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[#6b6bb3]/75 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
