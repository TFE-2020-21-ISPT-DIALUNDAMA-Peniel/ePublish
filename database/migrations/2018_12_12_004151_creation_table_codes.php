<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->increments('idcodes');
            $table->string('code',45);
            $table->integer('matricule_etudiant');
            $table->integer('idsession_actives');
            $table->boolean('active')->default(false);
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->foreign('matricule_etudiant')
                  ->references('matricule')->on('etudiant');
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
        Schema::dropIfExists('codes');
    }
}
