<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('similiars', function (Blueprint $table) {
            $table->bigInteger('hadith_id')
                ->unsigned();
            $table->foreign('hadith_id')
                ->references('id')
                ->on('hadiths')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('similiar_hadith_id')
                ->unsigned();
            $table->foreign('similiar_hadith_id')
                ->references('id')
                ->on('hadiths')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['hadith_id', 'similiar_hadith_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('similiars');
    }
}
