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
        Schema::create('personalized', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_color');
            $table->string('leaf_color');
            $table->string('additional_word');
            $table->string('power_supply');
            $table->string('child_name');
            $table->string('pictureURL');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personalized');
    }
};
