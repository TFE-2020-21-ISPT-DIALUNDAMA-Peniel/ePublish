<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableBulletins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulletins', function (Blueprint $table) {
            $table->increments('idbulletins');
            $table->string('file',255);
            $table->integer('matricule_etudiant');
            $table->integer('idcodes');
            $table->integer('idsession_actives');
            $table->timestamps();
            $table->foreign('matricule_etudiant')
                  ->references('matricule')->on('etudiant');
            $table->foreign('idcodes')
                  ->references('idcodes')->on('codes');
            $table->foreign('idsession_actives')
                  ->references('idsession_actives')->on('session_actives');

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
        Schema::dropIfExists('bulletins');
    }
}
