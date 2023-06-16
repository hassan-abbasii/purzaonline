<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queries', function (Blueprint $table) {
           $table->id();
            $table->string('description')->default("");
            $table->string('response')->default("");
            $table->date('date');
            $table->string('status')->default("pending");
            $table->string('productStatus')->default("pending");
            $table->string('userStatus')->default("Allowed");
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('car_id')
                  ->constrained('car_details')
                  ->onDelete('cascade');
                  $table->foreignId('prod_id')
                  ->constrained('product_generals')
                  ->onDelete('cascade');
            $table->foreignId('shop_id')
                  ->constrained('shops')
                  ->onDelete('cascade');
            $table->boolean('isDeleted')->default(false);
             $table->boolean('isUserDeleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queries');
    }
};
