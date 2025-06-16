<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Lowongan Baru') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('lowongan.store') }}" method="POST">
                        @csrf

                        <!-- Judul Lowongan -->
                        <div class="mb-6">
                            <x-input-label for="judul" :value="__('Judul Lowongan')" />
                            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" 
                                placeholder="Contoh: Pekerja Konstruksi Bangunan" 
                                value="{{ old('judul') }}" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <x-input-label for="deskripsi" :value="__('Deskripsi Pekerjaan')" />
                            <textarea id="deskripsi" name="deskripsi" rows="5"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                placeholder="Jelaskan detail pekerjaan, persyaratan, dan tanggung jawab"
                                required>{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="mb-6">
                            <x-input-label for="kategori" :value="__('Kategori Pekerjaan')" />
                            <select id="kategori" name="kategori"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Konstruksi" {{ old('kategori') == 'Konstruksi' ? 'selected' : '' }}>Konstruksi</option>
                                <option value="Renovasi" {{ old('kategori') == 'Renovasi' ? 'selected' : '' }}>Renovasi</option>
                                <option value="Tukang Kayu" {{ old('kategori') == 'Tukang Kayu' ? 'selected' : '' }}>Tukang Kayu</option>
                                <option value="Tukang Batu" {{ old('kategori') == 'Tukang Batu' ? 'selected' : '' }}>Tukang Batu</option>
                                <option value="Elektrikal" {{ old('kategori') == 'Elektrikal' ? 'selected' : '' }}>Elektrikal</option>
                                <option value="Plumbing" {{ old('kategori') == 'Plumbing' ? 'selected' : '' }}>Plumbing</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-6">
                            <x-input-label for="lokasi" :value="__('Lokasi Pekerjaan')" />
                            <x-text-input id="lokasi" name="lokasi" type="text" class="mt-1 block w-full" 
                                placeholder="Contoh: Jl. Sudirman No. 10, Jakarta Pusat" 
                                value="{{ old('lokasi') }}" />
                            <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                        </div>

                        <!-- Gaji -->
                        <div class="mb-6">
                            <x-input-label for="gaji" :value="__('Gaji yang Ditawarkan')" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 dark:text-gray-400 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" id="gaji" name="gaji"
                                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 pl-10 pr-12 focus:border-yellow-500 focus:ring-yellow-500"
                                    placeholder="0"
                                    value="{{ old('gaji') }}">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <span class="text-gray-500 dark:text-gray-400 sm:text-sm">/hari</span>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('gaji')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <x-input-label for="status" :value="__('Status Lowongan')" />
                            <select id="status" name="status"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Ditutup" {{ old('status') == 'Ditutup' ? 'selected' : '' }}>Ditutup</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('lowongan.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-yellow-600 dark:bg-yellow-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 dark:hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                {{ __('Buat Lowongan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>