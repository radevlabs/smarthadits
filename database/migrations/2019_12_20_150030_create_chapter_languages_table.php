<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_languages', function (Blueprint $table) {
            $table->bigInteger('chapter_id')
                ->unsigned();
            $table->foreign('chapter_id')
                ->references('id')
                ->on('chapters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('language_id')
                ->unsigned();
            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');

            $table->unique(['chapter_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter_languages');
    }
}
