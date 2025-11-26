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
        Schema::create('ib', function (Blueprint $table) {
            $table->string('id_ib')->primary();
            $table->string('id_kejadian');
            $table->string('no_dokumen')->nullable();
            $table->string('id_staff');
            $table->string('pejantan');
            $table->string('hasil');
            // $table->string('status')->nullable()->default('Belum Ada Tindakan');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ib');
    }
};
