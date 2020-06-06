<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('surah_id')
                ->unsigned();
            $table->foreign('surah_id')
                ->references('id')
                ->on('surahs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('quran_page_id')
                ->unsigned();
            $table->foreign('quran_page_id')
                ->references('id')
                ->on('quran_pages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('order')
                ->unsigned();
            $table->integer('juz')
                ->unsigned();
            $table->longText('image')
                ->nullable();
            $table->text('latin')
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
        Schema::dropIfExists('verses');
    }
}
