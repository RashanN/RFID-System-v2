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
        //
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('showprice', 10, 2);
            $table->decimal('unitprice', 10, 2);
            $table->integer('stock_level')->default(0);
            $table->string('description');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('product_category_id')->references('id')->on('product_category')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
