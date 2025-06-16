<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama')" class="dark:text-gray-300" />
                        <x-text-input id="name" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" 
                            type="text" name="name" :value="$user->name ?? old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 dark:text-red-400" />
                    </div>

                    @if(Auth::user()->roles == "Admin")
                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="dark:text-gray-300" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" 
                            type="email" name="email" :value="$user->email ?? old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 dark:text-red-400" />
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-4">
                        <x-input-label for="roles" :value="__('Role')" class="dark:text-gray-300" />
                        <select id="roles" name="roles" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="Admin" {{ $user->roles == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Pekerja" {{ $user->roles == 'Pekerja' ? 'selected' : '' }}>Pekerja</option>
                            <option value="Perekrut" {{ $user->roles == 'Perekrut' ? 'selected' : '' }}>Perekrut</option>
                        </select>
                        <x-input-error :messages="$errors->get('roles')" class="mt-2 dark:text-red-400" />
                    </div>
                
                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="dark:text-gray-300" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" 
                            type="password" name="password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 dark:text-red-400" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="dark:text-gray-300" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" 
                            type="password" name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 dark:text-red-400" />
                    </div>
                    @endif

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition duration-200 dark:bg-gray-600 dark:hover:bg-gray-700">
                            {{ __('Kembali') }}
                        </a>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition duration-200 dark:bg-yellow-700 dark:hover:bg-yellow-800">
                            {{ __('Simpan Perubahan') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>