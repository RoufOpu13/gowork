<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Manajemen Pekerja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('manajemen.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block">Pekerja</label>
                    <select id="user_id" name="user_id" class="w-full border px-2 py-1" required>
                        <option value="">Pilih Pekerja</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Lowongan</label>
                    <select id="lowongan_id" name="lowongan_id" class="w-full border px-2 py-1" required>
                        <option value="">Pilih Lowongan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Jenis Kontrak</label>
                    <select name="jenis_kontrak" class="w-full border px-2 py-1" required>
                        <option value="">Pilih Jenis Kontrak</option>
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="proyek">Proyek</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="w-full border px-2 py-1" required>
                </div>

                <div class="mb-4">
                    <label class="block">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="w-full border px-2 py-1">
                </div>
                
                <div class="mb-4">
                    <label class="block">Status</label>
                    <select name="status" class="w-full border px-2 py-1" required>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                        <option value="diberhentikan">Diberhentikan</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block">Catatan</label>
                    <textarea name="catatan" class="w-full border px-2 py-1"></textarea>
                </div>
                
                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Simpan</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user_id').change(function () {
                var userId = $(this).val();
                if (userId) {
                    $.ajax({
                        url: '/get-lowongan/' + userId,
                        type: 'GET',
                        success: function (data) {
                            var lowonganSelect = $('#lowongan_id');
                            lowonganSelect.empty();
                            lowonganSelect.append('<option value="">Pilih Lowongan</option>');

                            $.each(data, function (key, lowongan) {
                                lowonganSelect.append('<option value="' + lowongan.id + '">' + lowongan.judul + '</option>');
                            });
                        }
                    });
                } else {
                    $('#lowongan_id').empty().append('<option value="">Pilih Lowongan</option>');
                }
            });
        });
    </script>
</x-app-layout>
