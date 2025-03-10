<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lowongan Pekerjaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                <a href="{{ route('lowongan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Lowongan</a>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-2 my-2">
                        {{ session('success') }}
                    </div>
                @endif
            @endif
            
            <table class="w-full border mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">No</th>
                        
                        @if(Auth::user() && in_array(Auth::user()->roles, ['Admin','Pekerja' ]))
                        <th class="border px-4 py-2">Perekrut</th>
                    @endif
                        <th class="border px-4 py-2">Judul</th>
                        <th class="border px-4 py-2">Deskripsi</th> <!-- Menambahkan Deskripsi -->
                        <th class="border px-4 py-2">Kategori</th> <!-- Menambahkan Kategori -->
                        <th class="border px-4 py-2">Lokasi</th>
                        <th class="border px-4 py-2">Gaji</th>
                        <th class="border px-4 py-2">Status</th>
                        @if(Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                            <th class="border px-4 py-2">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if ($lowongans->count() > 0)
                    @foreach ($lowongans as $index => $lowongan)
                        <tr>
                            <td scope="row"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-center">
                                {{ $loop->iteration }}
                            </td>
                            @if(Auth::user() && in_array(Auth::user()->roles, ['Admin','Pekerja' ]))
                            <td class="border px-4 py-2">{{ $lowongan->user->name ?? 'Tidak Diketahui' }}</td>

                        @endif
                            <td class="border px-4 py-2">{{ $lowongan->judul }}</td>
                            <td class="border px-4 py-2">{{ $lowongan->deskripsi }}</td>
                            <td class="border px-4 py-2">{{ $lowongan->kategori }}</td>
                            <td class="border px-4 py-2">{{ $lowongan->lokasi }}</td>
                            <td class="border px-4 py-2">Rp{{ number_format($lowongan->gaji) }}</td>
                            <td class="border px-4 py-2">{{ $lowongan->status }}</td>
                
                            @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                <td class="border px-4 py-2 flex space-x-2">
                                    <a href="{{ route('lowongan.edit', $lowongan->id) }}" 
                                       class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST"
                                          onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="border text-center px-4 py-2">Tidak ada data lowongan</td>
                    </tr>
                @endif
                
                </tbody>
            </table>
            <script>
                function confirmDelete(event) {
                    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        event.preventDefault(); // Mencegah form dikirim jika user memilih "Batal"
                        return false;
                    }
                    return true;
                }
            </script>
            @if ($lowongans->hasPages())  
                {{ $lowongans->links() }}
            @endif
        </div>
    </div>
</x-app-layout>
