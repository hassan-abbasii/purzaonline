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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('profit');
            $table->date('date');
            $table->string('status')->default('sold');
            $table->foreignId('prod_id')
                  ->constrained('inventory_products')
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
        Schema::dropIfExists('sales');
    }
};
