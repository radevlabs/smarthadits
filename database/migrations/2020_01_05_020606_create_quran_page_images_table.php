<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuranPageImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quran_page_images', function (Blueprint $table) {
            $table->bigInteger('quran_page_id')
                ->unsigned();
            $table->foreign('quran_page_id')
                ->references('id')
                ->on('quran_pages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('source_id')
                ->unsigned();
            $table->foreign('source_id')
                ->references('id')
                ->on('sources')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->longText('image');

            $table->unique(['quran_page_id', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quran_page_images');
    }
}
