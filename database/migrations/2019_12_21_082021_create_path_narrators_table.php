<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathNarratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('path_narrators', function (Blueprint $table) {
            $table->bigInteger('path_id')
                ->unsigned();
            $table->foreign('path_id')
                ->references('id')
                ->on('paths')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('narrator_id')
                ->unsigned();
            $table->foreign('narrator_id')
                ->references('id')
                ->on('narrators')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('order');

            $table->unique(['path_id', 'narrator_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('path_narrators');
    }
}
