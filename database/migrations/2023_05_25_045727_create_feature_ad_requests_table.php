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
        Schema::create('feature_ad_requests', function (Blueprint $table) {
            $table->id();
            $table->string('paymentStatus')->default('pending');
            $table->string('paymentMethod')->deafult('stripe');
            $table->string('status')->deafult('pending');
            $table->string('image');
            $table->string('description');
            $table->date('livedate')->default(null);
             $table->string('isUserDeleted')->default(false);
            $table->string('isDeleted')->default(false);
            $table->foreignId('shop_id')
                  ->constrained('shops')
                  ->onDelete('cascade');
           $table->foreignId('ad_id')
                  ->constrained('feature_ad_plans')
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
        Schema::dropIfExists('feature_ad_requests');
    }
};
