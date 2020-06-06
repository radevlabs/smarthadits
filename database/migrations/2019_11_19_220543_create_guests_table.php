<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->text('url');
            $table->string('iso_code')
                ->nullable();
            $table->string('country')
                ->nullable();
            $table->string('city')
                ->nullable();
            $table->string('state')
                ->nullable();
            $table->string('state_name')
                ->nullable();
            $table->string('postal_code')
                ->nullable();
            $table->string('lat')
                ->nullable();
            $table->string('lon')
                ->nullable();
            $table->string('timezone')
                ->nullable();
            $table->string('continent')
                ->nullable();
            $table->string('currency')
                ->nullable();
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
        Schema::dropIfExists('guests');
    }
}
