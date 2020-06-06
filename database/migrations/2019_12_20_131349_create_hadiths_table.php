<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHadithsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadiths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chapter_id')
                ->unsigned();
            $table->foreign('chapter_id')
                ->references('id')
                ->on('chapters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('validity_id')
                ->unsigned()
                ->nullable();
            $table->foreign('validity_id')
                ->references('id')
                ->on('validities')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->bigInteger('no');
            $table->boolean('ambiguism');
            $table->longText('info')
                ->nullable();

            $table->unique(['chapter_id', 'no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hadiths');
    }
}
