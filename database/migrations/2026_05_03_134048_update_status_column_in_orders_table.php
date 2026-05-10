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
    Schema::table('orders', function (Blueprint $table) {
        // Kita ubah menjadi string biasa dengan panjang 50 karakter agar aman
        $table->string('status', 50)->change();
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        // Kembalikan ke semula jika perlu (opsional)
        $table->string('status')->change();
    });
}
};
