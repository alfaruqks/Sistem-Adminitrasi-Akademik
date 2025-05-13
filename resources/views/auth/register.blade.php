<x-guest-layout>

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Register Akun</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                  :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- NIS/NIK -->
                <div>
                    <x-input-label for="nis" :value="__('NIS / NIK')" />
                    <x-text-input id="nis" class="block mt-1 w-full" type="text" name="nis"
                                  :value="old('nis')" required />
                    <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Role -->
                <div>
                    <x-input-label for="role" :value="__('Pilih Role')" />
                    <select name="role" id="role"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>
                        <option value="murid">Murid</option>
                        <option value="guru">Guru</option>
                        <option value="kurikulum">Kurikulum</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-primary-button>
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>
        </form>
    
</x-guest-layout>
