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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('status');
            $table->string('userStatus')->default("Allowed");
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('shop_id')
                  ->constrained('shops')
                  ->onDelete('cascade');
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('cascade');
            $table->foreignId('slot_id')
                  ->constrained('slots')
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
        Schema::dropIfExists('appointments');
    }
};
