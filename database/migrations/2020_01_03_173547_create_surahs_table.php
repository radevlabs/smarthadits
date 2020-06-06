<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surahs', function (Blueprint $table) {
            $table->bigInteger('id')
                ->unsigned()
                ->unique()
                ->primary();
            $table->string('name')
                ->unique();
            $table->string('arabic')
                ->unique();
            $table->integer('order')
                ->unsigned()
                ->unique();
            $table->integer('rukuk');
            $table->string('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surahs');
    }
}
