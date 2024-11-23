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
            // Menambahkan kolom plant_id sebagai foreign key
            $table->unsignedBigInteger('plant_id')->nullable();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             // Menghapus foreign key dan kolom plant_id
             $table->dropForeign(['plant_id']);
             $table->dropColumn('plant_id');
        });
    }
};
