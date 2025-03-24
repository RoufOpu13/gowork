<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('manajemen.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Type for search then enter"
                                    class="w-full relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300" />
                            </form>
                        </div>
                        @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                        <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('manajemen.create') }}"
                                class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                Add New
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
                                <tr class="bg-white text-gray-500 hover:text-black text-center border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">NO</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Lowongan</th>
                                    @if (Auth::user() && in_array(Auth::user()->roles, ['Admin',]))
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Perekrut</th>
                                    @endif
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Pekerja</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Jenis Kontrak</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Tanggal Mulai</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Tanggal Selesai</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Status</th>
                                    <th scope="col" class="px-4 py-2 border border-gray-300 dark:border-gray-700">Catatan</th>
                                    
                                    @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($manajemen as $tesmanajemen)
                                    <tr class="bg-white dark:bg-gray-900 border-b border-gray-300 dark:border-gray-700 text-black">
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left">{{ $tesmanajemen->lowongans->judul ?? '-' }}</td>
                                        @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', ]))
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left">{{ $tesmanajemen->lowongans->user->name ?? '-' }}</td>
                                        @endif
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left">{{ $tesmanajemen->users->name ?? '-' }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">{{ ucfirst($tesmanajemen->jenis_kontrak) }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                            {{ \Carbon\Carbon::parse($tesmanajemen->tanggal_mulai)->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                            {{ $tesmanajemen->tanggal_selesai ? \Carbon\Carbon::parse($tesmanajemen->tanggal_selesai)->translatedFormat('d F Y') : '-' }}
                                        </td>
                                        
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                            <span class="px-2 py-1 rounded {{ $tesmanajemen->status == 'aktif' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                                {{ ucfirst($tesmanajemen->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left">{{ $tesmanajemen->catatan ?? '-' }}</td>
                        
                                        @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                            <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('manajemen.destroy', $tesmanajemen->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                                <a href="{{ route('manajemen.edit', $tesmanajemen->id) }}" class="focus:outline-none text-gray-50 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5 dark:focus:ring-yellow-900">
                                                    EDIT
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                    HAPUS
                                                </button>
                                            </form>
                                        </td>
                                        
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-gray-500 p-3">Data Belum Tersedia!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        
                        <div class="relative p-3">
                        {{ $manajemen->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>