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
        Schema::create('databarangs', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('barang');
            $table->string('no_asset');
            $table->string('no_equipment');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('merk');
            $table->string('tipe');
            $table->string('sn');
            $table->enum('kelayakan', ['layak', 'tidaklayak']);
            $table->string('foto');
            $table->enum('status', ['dipinjam', 'kembali', 'dikantor']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databarangs');
    }
};