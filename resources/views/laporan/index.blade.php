<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('laporan.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Type for search then enter"
                                    class="w-full relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300" />
                            </form>
                        </div>
                        @if (Auth::user()->roles == 'Admin')
                            <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                                <a type="button" href="{{ route('laporan.create') }}"
                                    class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                    Add New
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
                                <tr
                                    class="bg-white text-gray-500 hover:text-black text-center border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">NO
                                    </th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        Lowongan ID</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        User ID</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        Tipe</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        Deskripsi</th>

                                    @if (Auth::user()->roles == 'Admin')
                                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporan as $data)
                                    <tr
                                        class="bg-white dark:bg-gray-900 border-b border-gray-300 dark:border-gray-700 text-black">
                                        <td
                                            class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-center">
                                            {{ ++$i }}</td>
                                        <td
                                            class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-left">
                                            {{ $data->lowongan_id }}</td>
                                        <td
                                            class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-left">
                                            {{ $data->user_id }}</td>
                                        <td
                                            class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-center">
                                            <span
                                                class="px-3 py-1 rounded text-xs font-semibold 
                                                {{ $data->tipe == 'Pelanggaran' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
                                                {{ $data->tipe }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-left">
                                            {{ $data->deskripsi }}
                                        </td>

                                        @if (Auth::user()->roles == 'Admin')
                                            <td
                                                class="px-4 py-2 border border-gray-300 text-black text-center dark:border-gray-700">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('laporan.destroy', $data->id) }}" method="POST">
                                                    <a href="{{ route('laporan.edit', $data->id) }}"
                                                        class="focus:outline-none text-gray-50 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                        EDIT
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                        HAPUS
                                                    </button>
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

                        <div class="relative p-3">
                            {{ $laporan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
