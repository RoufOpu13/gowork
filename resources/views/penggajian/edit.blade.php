<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Penggajian') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('penggajian.update', $penggajian->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Pilih User -->
                        <div>
                            <x-input-label for="user_id" :value="__('Pilih User')" />
                            <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $penggajian->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Gaji Pokok -->
                        <div class="mt-4">
                            <x-input-label for="gaji_pokok" :value="__('Gaji Pokok')" />
                            <x-text-input id="gaji_pokok" class="block mt-1 w-full" type="number" name="gaji_pokok" :value="$penggajian->gaji_pokok ?? old('gaji_pokok')" required />
                            <x-input-error :messages="$errors->get('gaji_pokok')" class="mt-2" />
                        </div>

                        <!-- Tunjangan -->
                        <div class="mt-4">
                            <x-input-label for="tunjangan" :value="__('Tunjangan')" />
                            <x-text-input id="tunjangan" class="block mt-1 w-full" type="number" name="tunjangan" :value="$penggajian->tunjangan ?? old('tunjangan')" required />
                            <x-input-error :messages="$errors->get('tunjangan')" class="mt-2" />
                        </div>

                        <!-- Bonus -->
                        <div class="mt-4">
                            <x-input-label for="bonus" :value="__('Bonus')" />
                            <x-text-input id="bonus" class="block mt-1 w-full" type="number" name="bonus" :value="$penggajian->bonus ?? old('bonus')" />
                            <x-input-error :messages="$errors->get('bonus')" class="mt-2" />
                        </div>

                        <!-- Total Gaji -->
                        <div class="mt-4">
                            <x-input-label for="total_gaji" :value="__('Total Gaji')" />
                            <x-text-input id="total_gaji" class="block mt-1 w-full" type="number" name="total_gaji" :value="$penggajian->total_gaji ?? old('total_gaji')" required readonly />
                            <x-input-error :messages="$errors->get('total_gaji')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('penggajian.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>