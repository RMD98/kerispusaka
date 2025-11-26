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
        Schema::create('staff', function (Blueprint $table) {
            $table->string('id_staff')->primary();
            $table->string('nama');
            // $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            // $table->string('jabatan')->nullable();
            // $table->string('alamat')->nullable();
            $table->string('surat_izin')->nullable();
            $table->string('asal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
