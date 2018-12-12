<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableFacultes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultes', function (Blueprint $table) {
            $table->increments('idfacultes');
            $table->string('lib',65);
            $table->string('abbr',65);
            $table->integer('id_session');
            $table->foreign('id_section')
                  ->references('idsections')->on('sections');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facultes');
    }
}
