<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('harvest_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->cascadeOnDelete();
            $table->string('crop_type');
            $table->date('planting_date');
            $table->date('estimated_harvest_date');
            $table->date('actual_harvest_date')->nullable();
            $table->decimal('estimated_yield', 10, 2);
            $table->decimal('actual_yield', 10, 2)->nullable();
            $table->string('yield_unit');
            $table->decimal('production_cost', 10, 2);
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harvest_data');
    }
};
