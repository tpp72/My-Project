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
        Schema::create('entry_exit_devices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parking_lot_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('device_type', ['gate', 'camera', 'scanner']);
            $table->string('location');
            $table->enum('status', ['online', 'offline'])
                ->default('online');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_exit_devices');
    }
};
