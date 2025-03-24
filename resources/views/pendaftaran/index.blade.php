<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pendaftaran') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('pendaftaran.index') }}" method="GET" class="mb-4">
                                <input type="text" name="search" placeholder="Cari " 
                                    class="w-full px-4 py-2 border rounded-md" value="{{ request()->search }}">
                            </form>
                                                      
                        </div>
                        <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            @if (Auth::user() && in_array(Auth::user()->roles, ['Pekerja','Admin']))
                                <a href="{{ route('pendaftaran.create') }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">Tambah
                                    Pendaftaran</a>

                                @if (session('success'))
                                    <div class="bg-green-500 text-white p-2 my-2">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full border mt-4">
                            <thead>
                                <tr class="bg-white text-gray-500 hover:text-black text-center border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">No</th>
                                    @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                        <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Calon Pekerja</th>
                                    @endif
                                    @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                        <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Perekrut</th>
                                    @endif

                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Lowongan</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Pengalaman</th> <!-- Menambahkan Deskripsi -->
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Keahlian</th> <!-- Menambahkan Kategori -->
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Status</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pendaftaran->count() > 0)
                                    @foreach ($pendaftaran as $index => $daftar)
                                        <tr>
                                            <td scope="row"
                                                class="px-4 py-2 border  border-gray-300 dark:border-gray-700 text-black text-center">
                                                {{ ++$i }}
                                            </td>
                                            @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                                <td class="border px-4 py-2">
                                                    {{ $daftar->user->name ?? 'Tidak Diketahui' }}
                                                </td>
                                            @endif

                                            @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                                <td class="border px-4 py-2">
                                                    {{ $daftar->lowongan->user->name ?? 'Tidak Diketahui' }}</td>
                                            @endif
                                            <td class="border px-4 py-2">{{ $daftar->lowongan->judul }}</td>
                                            <td class="border px-4 py-2">{{ $daftar->pengalaman }}</td>
                                            <td class="border px-4 py-2">{{ $daftar->keahlian }}</td>
                                            <td class="border px-4 py-2">{{ $daftar->status }}</td>

                                            @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                                <td class="border px-4 py-2 text-center">
                                                    <div class="flex justify-center gap-2">
                                                        <a href="{{ route('pendaftaran.edit', $daftar->id) }}"
                                                            class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-xs px-3 py-2">
                                                            EDIT
                                                        </a>
                                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                            action="{{ route('pendaftaran.destroy', $daftar->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-xs px-3 py-2">
                                                                HAPUS
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                            @if (Auth::user() && in_array(Auth::user()->roles, ['Perekrut']))
                                                <td class="border px-4 py-2 text-center">
                                                    <div class="flex justify-center gap-2">
                                                        <form action="{{ route('pendaftaran.terima', $daftar->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Terima pendaftaran ini?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-xs px-3 py-2">
                                                                TERIMA
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('pendaftaran.tolak', $daftar->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Tolak pendaftaran ini?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-xs px-3 py-2">
                                                                TOLAK
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="border text-center px-4 py-2">Tidak ada data
                                            pendaftaran
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div>
                            {{ $pendaftaran->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
