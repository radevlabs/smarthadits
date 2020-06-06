<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarratorCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narrator_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('narrator_id')
                ->nullable()
                ->unsigned();
            $table->foreign('narrator_id')
                ->references('id')
                ->on('narrators')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->string('dominie')
                ->nullable();
            $table->longText('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('narrator_comments');
    }
}
