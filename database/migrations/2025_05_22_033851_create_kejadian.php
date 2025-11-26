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
        Schema::create('kejadian', function (Blueprint $table) {
            $table->string('id_kejadian')->primary();
            $table->string('id_betina');
            $table->string('id_peternak');
            $table->string('status')->nullable()->default('Belum Ada Tindakan');
            // $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian');
    }
};
