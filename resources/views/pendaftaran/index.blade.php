<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Filter and Search Section -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Search Input -->
                    <div class="w-full md:w-1/3">
                        <form action="{{ route('pendaftaran.index') }}" method="GET">
                            <div class="relative">
                                <input type="text" name="search" placeholder="Cari pendaftaran..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    value="{{ request()->search }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </form>

                    </div>
                    @if (Auth::user() && in_array(Auth::user()->roles, ['Pekerja', 'Admin']))
                        <a href="{{ route('pendaftaran.create') }}"
                            class="flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition duration-200 dark:bg-yellow-700 dark:hover:bg-yellow-800 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Pendaftaran
                        </a>
                    @endif

                    <!-- Export Buttons -->
                    @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                        <div class="flex space-x-2">
                            <a href="{{ route('pendaftaran.export.pdf', [
                                'tanggal_mulai' => request('tanggal_mulai'),
                                'tanggal_selesai' => request('tanggal_selesai'),
                                'perekrut_id' => request('perekrut_id'),
                            ]) }}"
                                onclick="return confirm('Yakin ingin mengekspor data ke PDF sesuai filter?')"
                                class="flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                PDF
                            </a>

                            @if (!request('tanggal_mulai') && !request('tanggal_selesai') && !request('perekrut_id') && !request('search'))
                                <a href="{{ route('pendaftaran.excel') }}"
                                    onclick="return confirm('Yakin ingin mengekspor semua data ke Excel?')"
                                    class="flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Excel
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Advanced Filters (Admin Only) -->
                @if (Auth::user() && in_array(Auth::user()->roles, ['Admin']))
                    <div class="mt-6">
                        <form method="GET" action="{{ route('pendaftaran.index') }}"
                            class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Perekrut Select -->
                            <div>
                                <label for="perekrut_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Perekrut</label>
                                <select name="perekrut_id" id="perekrut_id"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-gray-600">
                                    <option value="">Semua Perekrut</option>
                                    @foreach ($perekruts as $perekrut)
                                        <option value="{{ $perekrut->id }}"
                                            {{ request('perekrut_id') == $perekrut->id ? 'selected' : '' }}>
                                            {{ $perekrut->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Range -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal
                                    Mulai</label>
                                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-gray-600">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal
                                    Selesai</label>
                                <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-gray-600">
                            </div>

                            <div class="flex items-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition duration-200">
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 dark:bg-green-800 dark:border-green-600 dark:text-green-100">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Pendaftaran Table -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    No</th>
                                @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Calon Pekerja</th>
                                @endif
                                @if (Auth::user() && in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Perekrut</th>
                                @endif
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Lowongan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Pengalaman</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Keahlian</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tanggal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($pendaftaran as $index => $daftar)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ ++$i }}</td>

                                    @if (in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <svg class="h-10 w-10 rounded-full text-gray-400"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $daftar->user->name ?? 'Tidak Diketahui' }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $daftar->user->email ?? '' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif

                                    @if (in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $daftar->lowongan->user->name ?? 'Tidak Diketahui' }}
                                        </td>
                                    @endif

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $daftar->lowongan->judul }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ Str::limit($daftar->pengalaman, 30) }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ Str::limit($daftar->keahlian, 30) }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($daftar->tanggal_pendaftaran)->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                                'diterima' => 'bg-green-100 text-green-800',
                                                'ditolak' => 'bg-red-100 text-red-800',
                                            ];
                                            $colorClass =
                                                $statusColors[strtolower($daftar->status)] ??
                                                'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                            {{ ucfirst($daftar->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            @if (in_array(Auth::user()->roles, ['Admin', 'Pekerja']))
                                                <a href="{{ route('pendaftaran.edit', $daftar->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('pendaftaran.destroy', $daftar->id) }}"
                                                    method="POST" onsubmit="return confirm('Apakah Anda Yakin ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif

                                            @if (in_array(Auth::user()->roles, ['Perekrut']))
                                                <form action="{{ route('pendaftaran.terima', $daftar->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Terima pendaftaran ini?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                <form action="{{ route('pendaftaran.tolak', $daftar->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Tolak pendaftaran ini?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif

                                            @if (in_array(Auth::user()->roles, ['Perekrut', 'Admin']))
                                                <a href="{{ route('pendaftaran.print', $daftar->id) }}"
                                                    onclick="return confirmAndDownloadLink(this, event)"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada data pendaftaran
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                    {{ $pendaftaran->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function confirmExport(type) {
                if (confirm("Yakin ingin mengekspor data ke " + type.toUpperCase() + "?")) {
                    if (type === 'excel') {
                        window.location.href = "{{ route('pendaftaran.excel') }}";
                    } else if (type === 'pdf') {
                        window.location.href = "{{ route('pendaftaran.export.pdf') }}";
                    }
                }
            }

            function confirmAndDownloadLink(link, event) {
                event.preventDefault();
                const confirmed = confirm("Yakin ingin mencetak dan mengunduh PDF pendaftaran ini?");
                if (confirmed) {
                    const iframe = document.createElement('iframe');
                    iframe.style.display = 'none';
                    iframe.src = link.href;
                    document.body.appendChild(iframe);
                }
                return false;
            }
        </script>
    @endpush
</x-app-layout>
