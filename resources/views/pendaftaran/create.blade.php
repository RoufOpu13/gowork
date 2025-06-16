<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pendaftaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                        @csrf

                        <!-- Hidden Fields -->
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="tanggal_pendaftaran" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        <input type="hidden" name="status" value="Menunggu">

                        <!-- Lowongan -->
                        <div class="mb-6">
                            <x-input-label for="lowongan_id" :value="__('Pilih Lowongan')" />
                            <select id="lowongan_id" name="lowongan_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                required>
                                <option value="">-- Pilih Lowongan --</option>
                                @foreach ($lowongans as $lowongan)
                                    @if ($lowongan->status !== 'Ditutup')
                                        <option value="{{ $lowongan->id }}" {{ old('lowongan_id') == $lowongan->id ? 'selected' : '' }}>
                                            {{ $lowongan->judul }} ({{ $lowongan->user->name }}) - {{ Str::limit($lowongan->deskripsi, 50) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lowongan_id')" class="mt-2" />
                        </div>

                        <!-- Pengalaman -->
                        <div class="mb-6">
                            <x-input-label for="pengalaman" :value="__('Pengalaman Kerja')" />
                            <textarea id="pengalaman" name="pengalaman" rows="4"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                placeholder="Deskripsikan pengalaman kerja Anda sebelumnya"
                                required>{{ old('pengalaman') }}</textarea>
                            <x-input-error :messages="$errors->get('pengalaman')" class="mt-2" />
                        </div>

                        <!-- Keahlian -->
                        <div class="mb-6">
                            <x-input-label for="keahlian" :value="__('Keahlian Khusus')" />
                            <input id="keahlian" type="text" name="keahlian"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                value="{{ old('keahlian') }}"
                                placeholder="Contoh: Tukang Batu, Tukang Kayu, Mekanik, dll"
                                required>
                            <x-input-error :messages="$errors->get('keahlian')" class="mt-2" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('pendaftaran.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-yellow-600 dark:bg-yellow-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 dark:hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                {{ __('Daftar Sekarang') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>