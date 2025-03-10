<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Lowongan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('lowongan.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block">Judul</label>
                    <input type="text" name="judul" class="w-full border px-2 py-1" required>
                </div>

                <div class="mb-4">
                    <label class="block">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border px-2 py-1" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block">Kategori</label>
                    <input type="text" name="kategori" class="w-full border px-2 py-1" required>
                </div>
                



                <div class="mb-4">
                    <label class="block">Lokasi</label>
                    <input type="text" name="lokasi" class="w-full border px-2 py-1">
                </div>

                <div class="mb-4">
                    <label class="block">Gaji</label>
                    <input type="number" name="gaji" class="w-full border px-2 py-1">
                </div>
                <div class="mb-4">
                    <label class="block">Status</label>
                    <select name="status" class="w-full border px-2 py-1" required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Ditutup">Ditutup</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
