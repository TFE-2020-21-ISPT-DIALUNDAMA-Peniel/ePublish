<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('idusers');
            $table->string('user_name');
            $table->string('name');
            $table->string('last_name');
            $table->string('password');
            $table->integer('id_sections');
            $table->integer('idusers_roles');
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->foreign('idsessions')
                  ->references('idsessions')->on('sessions');
            $table->foreign('idusers_roles')
                  ->references('idusers_roles')->on('users_roles');

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
        Schema::dropIfExists('users');
    }
}
