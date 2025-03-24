<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Pendaftaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('pendaftaran.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                

                <div class="mb-4">
                    <label class="block">Lowongan</label>
                    <select name="lowongan_id" class="w-full border px-2 py-1" required>
                        <option value="">Pilih Lowongan</option>
                        @foreach ($lowongans as $lowongan)
                            @if ($lowongan->status !== 'Ditutup') <!-- Pastikan lowongan tidak ditutup -->
                                <option value="{{ $lowongan->id }}"> {{ $lowongan->user->name }} - {{ $lowongan->judul }} - {{ $lowongan->deskripsi }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                

                <div class="mb-4">
                    <label class="block">Pengalaman</label>
                    <textarea name="pengalaman" class="w-full border px-2 py-1"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block">Keahlian</label>
                    <input type="text" name="keahlian" class="w-full border px-2 py-1">
                </div>

                <input type="hidden" name="status" value="Menunggu">


                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
