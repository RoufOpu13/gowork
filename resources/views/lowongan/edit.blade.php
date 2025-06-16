<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-4">
                        <x-input-label for="judul" :value="__('Judul')" class="dark:text-gray-300" />
                        <x-text-input id="judul" name="judul" type="text" class="block mt-1 w-full" 
                            :value="$lowongan->judul" required 
                            class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" />
                        <x-input-error :messages="$errors->get('judul')" class="mt-2 dark:text-red-400" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" class="dark:text-gray-300" />
                        <textarea id="deskripsi" name="deskripsi" required
                            class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 min-h-[120px]"
                            >{{ $lowongan->deskripsi }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2 dark:text-red-400" />
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <x-input-label for="kategori" :value="__('Kategori')" class="dark:text-gray-300" />
                        <x-text-input id="kategori" name="kategori" type="text" class="block mt-1 w-full" 
                            :value="$lowongan->kategori" required 
                            class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" />
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2 dark:text-red-400" />
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-4">
                        <x-input-label for="lokasi" :value="__('Lokasi')" class="dark:text-gray-300" />
                        <x-text-input id="lokasi" name="lokasi" type="text" class="block mt-1 w-full" 
                            :value="$lowongan->lokasi"
                            class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" />
                        <x-input-error :messages="$errors->get('lokasi')" class="mt-2 dark:text-red-400" />
                    </div>

                    <!-- Gaji -->
                    <div class="mb-4">
                        <x-input-label for="gaji" :value="__('Gaji')" class="dark:text-gray-300" />
                        <x-text-input id="gaji" name="gaji" type="number" class="block mt-1 w-full" 
                            :value="$lowongan->gaji"
                            class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-yellow-500 focus:border-yellow-500" />
                        <x-input-error :messages="$errors->get('gaji')" class="mt-2 dark:text-red-400" />
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Status')" class="dark:text-gray-300" />
                        <select id="status" name="status" required
                            class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="Aktif" {{ $lowongan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Ditutup" {{ $lowongan->status == 'Ditutup' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2 dark:text-red-400" />
                    </div>

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition duration-200 dark:bg-gray-600 dark:hover:bg-gray-700">
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