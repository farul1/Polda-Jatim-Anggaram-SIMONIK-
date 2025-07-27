<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->string('laporan_kebutuhan');
            $table->string('laporan_keuangan_lalu');
            $table->decimal('jumlah_diajukan', 15, 2);
            $table->enum('status', ['Diproses', 'Selesai', 'Ditolak'])->default('Diproses');
            $table->text('reply_message')->nullable();
            $table->string('reply_image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
