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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->integer('hour');
            $table->foreignId('mechanic_id')
                  ->constrained('mechanics')
                  ->onDelete('cascade');

            $table->foreignId('cc_id')
                  ->constrained('car_ccs')
                  ->onDelete('cascade');
                  
            $table->foreignId('service_id')
                  ->constrained('mechanic_services')
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
        Schema::dropIfExists('services');
    }
};
