<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Pekerja
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade'); // Lowongan
            $table->decimal('gaji', 15, 2); // Jumlah Gaji
            $table->date('tanggal_pembayaran');
            $table->enum('status', ['Belum Dibayar', 'Dibayar'])->default('Belum Dibayar'); // Status Pembayaran
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penggajians');
    }
};
