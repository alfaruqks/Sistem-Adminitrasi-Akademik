<x-guest-layout>

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- NIS/NIK -->
        <div class="mb-4">
            <x-input-label for="nis" :value="__('NIS / NIK')" />
            <x-text-input   id="nis" class="block mt-1 w-full" type="text" name="nis"  :value="old('nis')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nis')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="flex justify-end">
            <x-primary-button class="ml-2">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>

