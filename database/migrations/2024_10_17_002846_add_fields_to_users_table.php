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
        Schema::table('users', function (Blueprint $table) {
            //$table->string('nik')->unique()->nullable(); // Kolom NIK, unik dan nullable
            $table->string('username')->nullable(); // Kolom username
            $table->string('nomor_hp')->nullable(); // Kolom nomor HP
            $table->string('plant')->nullable(); // Kolom plant
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable(); // Kolom jenis kelamin
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'username', 'nomor_hp', 'plant', 'jenis_kelamin']);
        });
    }
};
