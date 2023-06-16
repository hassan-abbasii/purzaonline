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
        Schema::create('inventory_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('actualPrice');
            $table->float('sellingPrice');
            $table->integer('quantity');
            $table->string('image');
            $table->string('condition');
            $table->string('brand');
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
        Schema::dropIfExists('inventory_products');
    }
};
