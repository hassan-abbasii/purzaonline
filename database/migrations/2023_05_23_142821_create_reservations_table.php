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
        Schema::create('reservations', function (Blueprint $table) {
             $table->id();
            $table->integer('quantity');
            $table->string('status')->default('active');
            $table->string('isUserDeleted')->default(false);
            $table->string('isDeleted')->default(false);
            $table->string('userStatus')->default('Allowed');
            $table->foreignId('prod_id')
                  ->constrained('inventory_products')
                  ->onDelete('cascade');
             $table->foreignId('shop_id')
                  ->constrained('shops')
                  ->onDelete('cascade');
          $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('reservations');
    }
};
