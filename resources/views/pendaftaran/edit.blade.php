<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Hidden Fields -->
                        <input type="hidden" name="user_id" value="{{ $pendaftaran->user_id }}">
                        <input type="hidden" name="tanggal_pendaftaran" value="{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('Y-m-d') }}">
                        <input type="hidden" name="lowongan_id" value="{{ $pendaftaran->lowongan_id }}">

                        <!-- Informasi Lowongan (Readonly) -->
                        <div class="mb-6">
                            <x-input-label for="lowongan_info" :value="__('Lowongan')" />
                            <input id="lowongan_info" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded-md shadow-sm" 
                                   value="{{ $pendaftaran->lowongan->judul }}" readonly>
                        </div>

                        <!-- Pengalaman -->
                        <div class="mb-6">
                            <x-input-label for="pengalaman" :value="__('Pengalaman Kerja')" />
                            <textarea id="pengalaman" name="pengalaman" rows="4"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                required>{{ old('pengalaman', $pendaftaran->pengalaman) }}</textarea>
                            <x-input-error :messages="$errors->get('pengalaman')" class="mt-2" />
                        </div>

                        <!-- Keahlian -->
                        <div class="mb-6">
                            <x-input-label for="keahlian" :value="__('Keahlian Khusus')" />
                            <input id="keahlian" type="text" name="keahlian"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                                value="{{ old('keahlian', $pendaftaran->keahlian) }}"
                                placeholder="Contoh: Tukang Batu, Tukang Kayu, Mekanik, dll">
                            <x-input-error :messages="$errors->get('keahlian')" class="mt-2" />
                        </div>

                        <!-- Status (Hanya untuk Admin/Perekrut) -->
                        @if(in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                        <div class="mb-6">
                            <x-input-label for="status" :value="__('Status Pendaftaran')" />
                            <select id="status" name="status"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                <option value="Menunggu" {{ old('status', $pendaftaran->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diterima" {{ old('status', $pendaftaran->status) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ old('status', $pendaftaran->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('pendaftaran.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-yellow-600 dark:bg-yellow-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 dark:hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>