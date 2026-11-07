<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('market_prices', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('market_location');
            $table->decimal('price_per_unit', 10, 2);
            $table->string('unit');
            $table->date('date');
            $table->integer('demand_level');
            $table->string('trend');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('market_prices');
    }
};
