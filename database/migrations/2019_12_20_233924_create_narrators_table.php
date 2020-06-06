<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narrators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('circle_id')
                ->nullable()
                ->unsigned();
            $table->foreign('circle_id')
                ->references('id')
                ->on('circles')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->bigInteger('live_country_id')
                ->nullable()
                ->unsigned();
            $table->foreign('live_country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->bigInteger('dead_country_id')
                ->nullable()
                ->unsigned();
            $table->foreign('dead_country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->string('name');
            $table->string('lineage')
                ->nullable();
            $table->integer('quality')
                ->unsigned()
                ->nullable();
            $table->string('kuniyah')
                ->nullable();
            $table->string('laqob')
                ->nullable();
            $table->string('dead_at')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('narrators');
    }
}
