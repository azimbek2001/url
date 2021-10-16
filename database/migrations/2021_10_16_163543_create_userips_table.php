<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userips', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->unsignedBigInteger('links_id');
            $table->unsignedBigInteger('count')->default(1);
            $table->timestamps();
            $table->foreign('links_id')->references('id')->on('short_links');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userips');
    }
}


