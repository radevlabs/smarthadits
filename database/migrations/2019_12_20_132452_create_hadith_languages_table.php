<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHadithLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadith_languages', function (Blueprint $table) {
            $table->bigInteger('hadith_id')
                ->unsigned();
            $table->foreign('hadith_id')
                ->references('id')
                ->on('hadiths')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('language_id')
                ->unsigned();
            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->longText('content');
            $table->longText('summary')
                ->nullable();

            $table->unique(['hadith_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hadith_languages');
    }
}
