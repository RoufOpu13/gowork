<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lowongan Management') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('lowongan.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Type for search then enter"
                                    class="w-full relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300" />
                            </form>
                        </div>
                        @if(Auth::user()->roles == "Admin" )
                        <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('lowongan.create') }}"
                                class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                Add New
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
                                <tr
                                    class="bg-white text-gray-500 hover:text-black text-center border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        <span>NO</span>
                                    </th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        <span>Judul</span>
                                    </th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        <span>Deskripsi</span>
                                    </th>
                                    
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                        <span>Kategori</span>
                                    </th>
                                    
                                    @if(Auth::user()->roles == "Admin" )
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Aksi</span>
                                    </th>
                                    @elseif(Auth::user()->roles == "Perekrut" )
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Aksi</span>
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowongan as $data)
                                    <tr
                                    class="bg-white dark:bg-gray-900 border-b border-gray-300 dark:border-gray-700 text-black ">
                                        <td scope="row"
                                        class="px-4 py-2 border  border-gray-300 dark:border-gray-700 text-black text-center">
                                            {{ ++$i }}
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-left">
                                            {{ $data->judul }}
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black text-left">
                                            {{ $data->deskripsi }}
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 text-black text-center dark:border-gray-700">
                                            {{ $data->kategori }}
                                        </td>
                                        @if(Auth::user()->roles == "Admin")
                                        <td class="px-4 py-2 border border-gray-300 text-black text-center dark:border-gray-700">
                                           
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('lowongan.destroy', $data->id) }}" method="POST">
                                                <a href="{{ route('lowongan.edit', $data->id) }}"
                                                    class="focus:outline-none text-gray-50 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                    HAPUS</button>
                                            </form>
                                           
                                        </td>
                                        @elseif(Auth::user()->roles == "Perekrut")
                                        <td class="px-4 py-2 border border-gray-300 text-black text-center dark:border-gray-700">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('lowongan.destroy', $data->id) }}" method="POST">
                                            <a href="{{ route('lowongan.edit', $data->id) }}"
                                                class="focus:outline-none text-gray-50 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">EDIT</a>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <div class="bg-gray-500 text-white p-3 rounded shadow-sm mb-3">
                                        Data Belum Tersedia!
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="relative p-3">
                        {{ $lowongan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>