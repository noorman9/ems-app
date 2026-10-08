<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->foreignId('equipment_id')
                ->constrained('equipment')
                ->cascadeOnDelete();

            $table->foreignId('technician_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('type');
            $table->date('scheduled_date');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('status')->default('scheduled');
            $table->text('description')->nullable();
            $table->decimal('cost', 15, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropForeign(['equipment_id']);
            $table->dropForeign(['technician_id']);

            $table->dropColumn([
                'equipment_id',
                'technician_id',
                'type',
                'scheduled_date',
                'started_at',
                'completed_at',
                'status',
                'description',
                'cost',
            ]);
        });
    }
};
