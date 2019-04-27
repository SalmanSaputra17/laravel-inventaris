<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('inventary_code');
            $table->string('name');
            $table->string('condition');
            $table->integer('mount')->unsigned();
            $table->integer('type_id');
            $table->integer('room_id');
            $table->integer('user_id')->nullable();
            $table->date('register_date');
            $table->string('explanation')->nullable();
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
        Schema::dropIfExists('inventaries');
    }
}
