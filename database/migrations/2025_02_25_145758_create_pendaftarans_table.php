<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
            
            $table->text('pengalaman')->nullable(); // Menyimpan pengalaman kerja pekerja
            $table->text('keahlian')->nullable(); // Menyimpan keterampilan pekerja
        
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
};
