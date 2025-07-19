<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('konselings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis'); // pribadi, akademik, sosial, karier
            $table->text('pesan'); // isi permintaan konseling
            $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');
            $table->text('tanggapan')->nullable(); // jawaban dari konselor
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konselings');
    }
};
