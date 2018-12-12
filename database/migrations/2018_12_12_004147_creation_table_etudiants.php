<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEtudiants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->integer('matricule');
            $table->string('nom',65);
            $table->string('postnom',65);
            $table->string('prenom',65);
            $table->integer('idauditoires');
            $table->integer('annee_acad');
            $table->boolean('statut')->default(false);
            $table->primary('matricule');
            $table->foreign('idauditoires')
                  ->references('idauditoires')->on('auditoires');
            $table->foreign('annee_acad')
                  ->references('idgestion_annees')->on('gestion_annees');
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
        Schema::dropIfExists('etudiants');
    }
}
