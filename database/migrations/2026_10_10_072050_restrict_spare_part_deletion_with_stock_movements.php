<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_movements', function (Blueprint $table) {
            $table->dropForeign('stock_movements_spare_part_id_foreign');
        });

        Schema::table('stock_movements', function (Blueprint $table) {
            $table->foreign('spare_part_id')
                ->references('id')
                ->on('spare_parts')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('stock_movements', function (Blueprint $table) {
            $table->dropForeign('stock_movements_spare_part_id_foreign');
        });

        Schema::table('stock_movements', function (Blueprint $table) {
            $table->foreign('spare_part_id')
                ->references('id')
                ->on('spare_parts')
                ->cascadeOnDelete();
        });
    }
};