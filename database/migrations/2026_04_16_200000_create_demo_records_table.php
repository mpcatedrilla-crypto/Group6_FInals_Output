<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Replaces any prior event-management tables with a neutral demo table for the course data-volume requirement.
     */
    public function up(): void
    {
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('events');
        Schema::dropIfExists('demo_records');

        Schema::create('demo_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demo_records');
    }
};
