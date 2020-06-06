<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hadith_id')
                ->unsigned();
            $table->foreign('hadith_id')
                ->references('id')
                ->on('hadiths')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('scheme_id')
                ->unsigned();
            $table->foreign('scheme_id')
                ->references('id')
                ->on('schemes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('position_id')
                ->unsigned();
            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('order');

            $table->unique(['hadith_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paths');
    }
}
