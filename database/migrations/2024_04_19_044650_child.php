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
        Schema::create('child', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('DOB');
            $table->string('profile_image')->nullable();
            $table->string('gender');
            $table->string('relationship');
            $table->string('school')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child');
    }
};
