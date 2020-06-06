<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerseTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verse_texts', function (Blueprint $table) {
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
            $table->bigInteger('source_id')
                ->unsigned();
            $table->foreign('source_id')
                ->references('id')
                ->on('sources')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('text');
            $table->longText('interpretation')
                ->nullable();

            $table->unique(['verse_id', 'language_id', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verse_texts');
    }
}
