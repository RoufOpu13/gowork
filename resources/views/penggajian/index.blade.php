<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penggajian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('penggajian.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Type for search then enter"
                                    class="w-full relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300" />
                            </form>
                        </div>

                        @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                            <div class="sm:ml-16 sm:mt-0 sm:flex-none space-x-2">
                                <a href="{{ route('penggajian.create') }}"
                                    class="inline-flex items-center px-4 py-2 font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Tambah Data
                                </a>
                                
                                <a href="#" onclick="confirmExport('excel')"
                                    class="inline-flex items-center px-4 py-2 font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Export Excel
                                </a>
                                <a href="#" onclick="confirmExport('pdf')"
                                    class="inline-flex items-center px-4 py-2 font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Export PDF
                                </a>
                                <script>
                                    function confirmExport(type) {
                                        const confirmation = confirm("Apakah Anda ingin mengexport ke " + (type === 'pdf' ? 'PDF' : 'Excel') + "?");
                                        if (confirmation) {
                                            if (type === 'pdf') {
                                                window.location.href = "{{ route('penggajian.export.pdf') }}";
                                            } else if (type === 'excel') {
                                                window.location.href = "{{ route('penggajian.export.excel') }}";
                                            }
                                        }
                                    }
                                </script>
                            </div>
                        @endif
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
                                <tr
                                    class="bg-white text-gray-500 hover:text-black text-center border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">NO</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Manajemen</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Gaji</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Tanggal Pembayaran
                                    </th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Status Pembayaran
                                    </th>
                                    @if (Auth::user()->roles == 'Admin')
                                        <th class="px-6 py-3 text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penggajian as $gaji)
                                    <tr
                                        class="bg-white dark:bg-gray-900 border-b border-gray-300 dark:border-gray-700 text-black">
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                            {{ ++$i }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                            {{ $gaji->manajemen ? $gaji->manajemen->users->name : 'Tidak Ada Data' }}
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                            Rp {{ number_format($gaji->gaji, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                            {{ date('d-m-Y', strtotime($gaji->tanggal_pembayaran)) }}
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                            <span
                                                class="px-3 py-1 rounded text-xs font-semibold {{ $gaji->status_pembayaran == 'Lunas' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                                {{ $gaji->status_pembayaran }}
                                            </span>
                                        </td>
                                        @if (Auth::user()->roles == 'Admin')
                                            <td
                                                class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('penggajian.destroy', $gaji->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('penggajian.edit', $gaji->id) }}"
                                                        class="text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded px-3 py-2 text-xs">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-700 font-medium rounded px-3 py-2 text-xs">HAPUS</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="bg-gray-500 text-white p-3 text-center rounded shadow-sm">
                                            Data Belum Tersedia!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-3">
                            {{ $penggajian->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
