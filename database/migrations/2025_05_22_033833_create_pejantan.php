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
        Schema::create('pejantan', function (Blueprint $table) {
            $table->string('id_pejantan')->primary();
            // $table->string('id_peternak');
            $table->string('id_pembuatan');
            // $table->string('nama');
            // $table->string('jenis_sapi');
            $table->string('jenis_straw')->nullable();
            // $table->string('ear_tag')->nullable();
            $table->string('asal_straw')->nullable();
            $table->integer('persentase')->nullable();
            // $table->date('tanggal_lahir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejantan');
    }
};
