<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lowongan Pekerjaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">

                        @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                            <div class="sm:ml-0 sm:mt-0 sm:flex gap-2">
                                <a href="{{ route('lowongan.create') }}"
                                    class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                    Tambah Lowongan
                                </a>

                                <a href="#" onclick="confirmExport('excel')"
                                    class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                    Export Excel
                                </a>

                                <a href="#" onclick="confirmExport('pdf')"
                                    class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                    Export PDF
                                </a>
                            </div>

                            @if (session('success'))
                                <div class="bg-green-500 text-white p-2 my-2">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <script>
                                function confirmExport(type) {
                                    const confirmation = confirm("Apakah Anda ingin mengexport ke " + (type === 'pdf' ? 'PDF' : 'Excel') + "?");
                                    if (confirmation) {
                                        if (type === 'pdf') {
                                            window.location.href = "{{ route('lowongan.export.pdf') }}";
                                        } else if (type === 'excel') {
                                            window.location.href = "{{ route('lowongan.export_excel') }}";
                                        }
                                    }
                                }
                            </script>
                        @endif

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full border mt-4">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border px-4 py-2">No</th>

                                    @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                        <th class="border px-4 py-2">Perekrut</th>
                                    @endif
                                    <th class="border px-4 py-2">Judul</th>
                                    <th class="border px-4 py-2">Deskripsi</th> <!-- Menambahkan Deskripsi -->
                                    <th class="border px-4 py-2">Kategori</th> <!-- Menambahkan Kategori -->
                                    <th class="border px-4 py-2">Lokasi</th>
                                    <th class="border px-4 py-2">Gaji</th>
                                    <th class="border px-4 py-2">Status</th>
                                    @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                        <th class="border px-4 py-2">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lowongans->count() > 0)
                                    @foreach ($lowongans as $index => $lowongan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                                <td class="border px-4 py-2">
                                                    {{ $lowongan->user->name ?? 'Tidak Diketahui' }}
                                                </td>
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
                                                    <form action="{{ route('lowongan.destroy', $lowongan->id) }}"
                                                        method="POST" onsubmit="return confirmDelete(event)">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                                            <i class="fas fa-trash mr-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="border text-center px-4 py-2">Tidak ada data lowongan
                                        </td>
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

                        <div class="relative p-3">
                            {{ $lowongans->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
