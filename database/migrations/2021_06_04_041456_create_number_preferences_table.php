<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_preferences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number_id')->unsigned();
            $table->string('name')->nullable(false);
            $table->string('value')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('number_preferences', function (Blueprint $table) {
            $table->foreign('number_id')->references('id')->on('numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('number_preferences');
    }
}
