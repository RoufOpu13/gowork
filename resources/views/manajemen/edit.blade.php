<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Manajemen Pekerja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('manajemen.update', $manajemen->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block">Nama Lowongan</label>
                    <input type="text" value="{{ $manajemen->lowongans->judul ?? '-' }}" class="w-full border px-2 py-1 bg-gray-200" readonly>
                </div>

                <div class="mb-4">
                    <label class="block">Nama Pekerja</label>
                    <input type="text" value="{{ $manajemen->users->name ?? '-' }}" class="w-full border px-2 py-1 bg-gray-200" readonly>
                </div>

                <div class="mb-4">
                    <label class="block">Jenis Kontrak</label>
                    <select name="jenis_kontrak" class="w-full border px-2 py-1" required>
                        <option value="harian" {{ $manajemen->jenis_kontrak == 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="mingguan" {{ $manajemen->jenis_kontrak == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="bulanan" {{ $manajemen->jenis_kontrak == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="proyek" {{ $manajemen->jenis_kontrak == 'proyek' ? 'selected' : '' }}>Proyek</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ $manajemen->tanggal_mulai }}" class="w-full border px-2 py-1" required>
                </div>

                <div class="mb-4">
                    <label class="block">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ $manajemen->tanggal_selesai }}" class="w-full border px-2 py-1">
                </div>

                <div class="mb-4">
                    <label class="block">Status</label>
                    <select name="status" class="w-full border px-2 py-1" required>
                        <option value="aktif" {{ $manajemen->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ $manajemen->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="diberhentikan" {{ $manajemen->status == 'diberhentikan' ? 'selected' : '' }}>Diberhentikan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Catatan</label>
                    <textarea name="catatan" class="w-full border px-2 py-1">{{ $manajemen->catatan }}</textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
