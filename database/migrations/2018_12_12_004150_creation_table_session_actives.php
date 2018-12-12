<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableSessionActives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_actives', function (Blueprint $table) {
            $table->increments('idsession_actives');
            $table->integer('idsessions');
            $table->integer('annee');
            $table->boolean('statut');
            $table->timestamps();
            $table->foreign('annee')
                  ->references('idgestion_annees')->on('gestion_annees');
            $table->foreign('idsessions')
                  ->references('idsessions')->on('sessions');

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
        Schema::dropIfExists('session_actives');
    }
}
