<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Gowork') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card Total Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-200 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $users }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Lowongan -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-200 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Lowongan</p>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $lowongans }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Manajemen -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-200 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Manajemen</p>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $manajemens }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Pendaftaran -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-200 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pendaftaran</p>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $pendaftarans }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik dan Data Tambahan untuk Admin -->
        @if(Auth::user()->roles === 'Admin')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Grafik Pendaftaran per Bulan -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pendaftaran per Bulan</h3>
                <canvas id="registrationsChart" height="300"></canvas>
            </div>

            <!-- Grafik Status Pendaftaran -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Status Pendaftaran</h3>
                <canvas id="statusChart" height="300"></canvas>
            </div>
        </div>

        <!-- Statistik Tambahan Admin -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Perekrut</p>
                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $totalRecruiters }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pekerja</p>
                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $totalWorkers }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Lowongan Aktif</p>
                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $activeJobs }}</p>
            </div>
        </div>
        @endif
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if(Auth::user()->roles === 'Admin')
        // Grafik Pendaftaran per Bulan
        const regCtx = document.getElementById('registrationsChart').getContext('2d');
        new Chart(regCtx, {
            type: 'line',
            data: {
                labels: @json($registrationData['months']),
                datasets: [{
                    label: 'Jumlah Pendaftaran',
                    data: @json($registrationData['counts']),
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Grafik Status Pendaftaran
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Diterima', 'Ditolak'],
                datasets: [{
                    data: [
                        {{ $registrationData['status']['menunggu'] }},
                        {{ $registrationData['status']['diterima'] }},
                        {{ $registrationData['status']['ditolak'] }}
                    ],
                    backgroundColor: [
                        'rgba(234, 179, 8, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
        @endif
    </script>
    @endpush
</x-app-layout>