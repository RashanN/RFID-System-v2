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

        Schema::create('discount', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->decimal('price', 10, 2); // Assuming a decimal field for price with precision of 10 digits and 2 decimal places
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
            Schema::dropIfExists('discount');
    }
};
