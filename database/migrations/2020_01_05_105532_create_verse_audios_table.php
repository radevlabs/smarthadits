<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVerseAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verse_audios', function (Blueprint $table) {
            $table->bigInteger('verse_id')
                ->unsigned();
            $table->foreign('verse_id')
                ->references('id')
                ->on('verses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('reciter_id')
                ->unsigned();
            $table->foreign('reciter_id')
                ->references('id')
                ->on('reciters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->longText('audio');

            $table->unique(['verse_id', 'reciter_id']);
        });

        DB::statement('alter table verse_audios modify audio longblob not null');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verse_audios');
    }
}
