<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigInteger('verse_id')
                ->unsigned();
            $table->foreign('verse_id')
                ->references('id')
                ->on('verses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('language_id')
                ->unsigned();
            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('order')
                ->unsigned();
            $table->string('word');

            $table->unique(['verse_id', 'language_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
}
