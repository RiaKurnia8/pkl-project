<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('data_barangs', function (Blueprint $table) {
        $table->unsignedBigInteger('kategori_id')->nullable(); // Tanpa `after`
        // Atau jika Anda ingin menambahkannya setelah kolom tertentu yang ada
        // $table->unsignedBigInteger('kategori_id')->nullable()->after('kolom_yang_ada');
    });
}

public function down()
{
    Schema::table('barang', function (Blueprint $table) {
        // Jika ingin membatalkan perubahan
        $table->dropForeign(['kategori_id']);
        $table->dropColumn('kategori_id');
    });
}
};
