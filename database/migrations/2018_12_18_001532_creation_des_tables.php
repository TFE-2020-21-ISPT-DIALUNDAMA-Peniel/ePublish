<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationDesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('idpromotions');
            $table->string('lib',65);
            $table->string('abbr',65);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('idsections');
            $table->string('lib',65);
            $table->string('abbr',65);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('facultes', function (Blueprint $table) {
            $table->increments('idfacultes');
            $table->string('lib',65);
            $table->string('abbr',65);
            $table->unsignedInteger
            ('idsections'); 
            $table->foreign('idsections')
                  ->references('idsections')->on('sections')
                  ->onDelete('cascade');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('auditoires', function (Blueprint $table) {
            $table->increments('idauditoires');
            $table->string('lib',65);
            $table->string('abbr',65);
            $table->unsignedInteger('idfacultes');
            $table->unsignedInteger('idpromotions');
            $table->unsignedInteger('idsections');
            $table->foreign('idfacultes')
                  ->references('idfacultes')->on('facultes');
            $table->foreign('idpromotions')
                  ->references('idpromotions')->on('promotions');
            $table->foreign('idsections')
                  ->references('idsections')->on('sections');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('gestion_annees', function (Blueprint $table) {
            $table->increments('idgestion_annees');
            $table->year('annee_debut');
            $table->year('annee_fin');
            $table->string('annee_format',10);
            $table->boolean('statut')->default(false);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

         Schema::create('etudiants', function (Blueprint $table) {
            $table->increments('idetudiants');
            $table->string('matricule',10)->unique();
            $table->string('nom',65);
            $table->string('postnom',65)->nullable();
            $table->string('prenom',65)->nullable();
            $table->unsignedInteger('idauditoires');
            $table->unsignedInteger('annee_acad');
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->foreign('idauditoires')
                  ->references('idauditoires')->on('auditoires')->onDelete('cascade');
            $table->foreign('annee_acad')
                  ->references('idgestion_annees')->on('gestion_annees')->onDelete('cascade');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('idsessions');
            $table->string('lib',65);
            $table->string('abbr',65);
            $table->string('folder',65);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('publications', function (Blueprint $table) {
            $table->increments('idpublications');
            $table->unsignedInteger('idsessions');
            $table->unsignedInteger('idauditoires');
            $table->unsignedInteger('annee');
            $table->boolean('statut')->default(1);
            $table->dateTime('date_publication')->default('NOW()');
            $table->timestamps();
            $table->foreign('annee')
                  ->references('idgestion_annees')->on('gestion_annees');
            $table->foreign('idsessions')
                  ->references('idsessions')->on('sessions');
            $table->foreign('idauditoires')
                  ->references('idauditoires')->on('auditoires');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

         Schema::create('etudiants_succes', function (Blueprint $table) {
            $table->unsignedInteger('idetudiants');
            $table->unsignedInteger('idsessions');
            $table->unsignedInteger('idgestion_annees');
            $table->timestamps();

            $table->primary(['idetudiants','idgestion_annees']);
            $table->foreign('idetudiants')
                  ->references('idetudiants')->on('etudiants')->onDelete('cascade');
            $table->foreign('idsessions')
                  ->references('idsessions')->on('sessions')->onDelete('cascade');
            $table->foreign('idgestion_annees')
                  ->references('idgestion_annees')->on('gestion_annees')->onDelete('cascade');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('codes', function (Blueprint $table) {
            $table->increments('idcodes');
            $table->string('code',45);
            $table->unsignedInteger('idetudiants');
            $table->unsignedInteger('idsessions');
            $table->boolean('active')->default(false);
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->unique('code');
            $table->foreign('idetudiants')
                  ->references('idetudiants')->on('etudiants')->onDelete('cascade');
            $table->foreign('idsessions')
                  ->references('idsessions')->on('sessions')->onDelete('cascade');
         

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('bulletins', function (Blueprint $table) {
            $table->increments('idbulletins');
            $table->text('file',255);
            $table->unsignedInteger('idetudiants');
            $table->unsignedInteger('idcodes');
            $table->unsignedInteger('idsessions'); // AAAAAAAAAAAAAAA SUPPRIMER
            $table->timestamps();
            $table->foreign('idetudiants')
                  ->references('idetudiants')->on('etudiants')->onDelete('cascade');
            $table->foreign('idcodes')
                  ->references('idcodes')->on('codes')->onDelete('cascade');
            $table->foreign('idsessions')
                  ->references('idsessions')->on('sessions')->onDelete('cascade');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('users_roles', function (Blueprint $table) {
            $table->increments('idusers_roles');
            $table->string('lib',65);
            $table->unsignedInteger('level');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('idusers');
            $table->string('username',45)->unique();
            $table->string('name',65);
            $table->string('first_name',65);
            $table->string('email',65)->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('idsections')->nullable();
            $table->unsignedInteger('idusers_roles');
            $table->boolean('statut')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idsections')
                  ->references('idsections')->on('sections')->onDelete('cascade');
            $table->foreign('idusers_roles')
                  ->references('idusers_roles')->on('users_roles')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('ventes', function (Blueprint $table) {
            $table->increments('idventes');
            $table->unsignedInteger('idusers');
            $table->unsignedInteger('idetudiants');
            $table->unsignedInteger('idcodes');
            $table->timestamps();
            $table->foreign('idusers')
                  ->references('idusers')->on('users')->raw('ON DELETE SET NULL');
            $table->foreign('idetudiants')
                  ->references('idetudiants')->on('etudiants')->raw('ON DELETE SET NULL');
            $table->foreign('idcodes')
                  ->references('idcodes')->on('codes')->raw('ON DELETE SET NULL');

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
        Schema::dropIfExists('ventes');
        Schema::dropIfExists('users');
        Schema::dropIfExists('users_roles');
        Schema::dropIfExists('bulletins');
        Schema::dropIfExists('codes');
        Schema::dropIfExists('etudiants_succes');
        Schema::dropIfExists('publications');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('etudiants');
        Schema::dropIfExists('gestion_annees');
        Schema::dropIfExists('auditoires');
        Schema::dropIfExists('facultes');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('promotions');
        

        
    }
}
