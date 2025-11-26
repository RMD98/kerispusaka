<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('betina', function (Blueprint $table) {
            $table->string('ear_tag')->primary();
            // $table->string('id_betina')->primary();
            $table->string('id_peternak');
            $table->string('nama');
            $table->string('jenis_sapi');
            $table->string('usia')->nullable();
            $table->string('foto')->nullable();
            $table->integer('jumlah_ib')->nullable();
            $table->string('riwayat_penyakit')->nullable();
            $table->string('status')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('betina');
    }
};
