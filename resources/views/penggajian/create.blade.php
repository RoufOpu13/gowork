<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Penggajian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('penggajian.store') }}" method="POST">
                        @csrf

                        <label for="user_id">Pilih Pekerja:</label>
                        <select name="user_id" id="user_id" required>
                            @foreach ($manajemens as $manajemen)
                                <option value="{{ $manajemen->user->id }}">
                                    {{ $manajemen->user->name }} - {{ $manajemen->lowongan->judul }}
                                </option>
                            @endforeach
                        </select>

                        <input type="hidden" name="lowongan_id" value="{{ $manajemen->lowongan->id }}" />

                        <label for="gaji">Gaji:</label>
                        <input type="number" name="gaji" required>

                        <label for="tanggal_pembayaran">Tanggal:</label>
                        <input type="date" name="tanggal_pembayaran" required>

                        <label for="status">Status:</label>
                        <select name="status">
                            <option value="belum dibayar">Belum Dibayar</option>
                            <option value="sudah dibayar">Sudah Dibayar</option>
                        </select>

                        <button type="submit">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Script AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userSelect = document.getElementById('user_id');
            const lowonganSelect = document.getElementById('lowongan_id');

            userSelect.addEventListener('change', function() {
                const userId = this.value;

                // Kosongkan dropdown lowongan
                lowonganSelect.innerHTML = '<option value="">-- Pilih Lowongan --</option>';

                if (userId) {
                    fetch(`/penggajian/lowongan-by-user/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                data.forEach(lowongan => {
                                    const option = document.createElement('option');
                                    option.value = lowongan.id;
                                    option.textContent = lowongan.judul;
                                    lowonganSelect.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'Tidak ada lowongan untuk user ini';
                                lowonganSelect.appendChild(option);
                            }
                        })
                        .catch(error => {
                            const option = document.createElement('option');
                            option.value = '';
                            option.textContent = 'Gagal memuat lowongan';
                            lowonganSelect.appendChild(option);
                        });
                }
            });
        });
    </script>
</x-app-layout>
