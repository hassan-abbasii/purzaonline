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
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('slot');
            $table->time('slot_time');
            $table->string('status')->default("Available");
            $table->foreignId('mechanic_id')
                  ->constrained('mechanics')
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
        Schema::dropIfExists('slots');
    }
};
