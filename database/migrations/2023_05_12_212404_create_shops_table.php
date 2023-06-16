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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('days');
            $table->time('openTime');
            $table->time('closeTime');
            $table->string('type');
            $table->string('status')->default('Not Verified');
             $table->foreignId('user_id')
                  ->constrained('users')
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
        Schema::dropIfExists('shops');
    }
};
