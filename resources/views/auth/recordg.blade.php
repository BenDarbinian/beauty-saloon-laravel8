<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="font-semibold font-bold text-4xl uppercase text-gray-900">Yasmin</a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('recordg') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Phone number -->
            <div class="mt-4">
                <x-label for="phone_number" :value="__('Phone number')" />

                <x-input id="phone-number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
            </div>



            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-3">
                    {{ __('Record') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>