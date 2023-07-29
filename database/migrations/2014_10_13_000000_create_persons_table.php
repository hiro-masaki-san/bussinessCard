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
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id'); // 主キー
            $table->unsignedInteger('groupId');
            $table->string('name');
            $table->string('ruby');
            $table->string('character');
            $table->string('memo');
            $table->string('imageName');
            $table->timestamps();
            
            $table->foreign('groupId')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
};
