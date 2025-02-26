<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
            $table->foreignId('pemberi_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pekerja_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating');
            $table->text('komentar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasans');
    }
};
