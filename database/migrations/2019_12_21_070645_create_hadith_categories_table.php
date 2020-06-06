<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHadithCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadith_categories', function (Blueprint $table) {
            $table->bigInteger('hadith_id')
                ->unsigned();
            $table->foreign('hadith_id')
                ->references('id')
                ->on('hadiths')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('category_id')
                ->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['hadith_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hadith_categories');
    }
}
