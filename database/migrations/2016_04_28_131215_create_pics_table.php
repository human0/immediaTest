<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pics', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('search');
            $table->string('caption');
            $table->string('link');
            $table->string('low_resolution');
            $table->string('thumbnail');
            $table->string('standard_resolution');
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
        Schema::drop('pics');
    }
}
