<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableAuditoires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoires', function (Blueprint $table) {
            $table->increments('idauditoires');
            $table->string('lib',65);
            $table->string('abbr',65);
            $table->integer('idfacultes');
            $table->integer('idpromotions');
            $table->foreign('idfacultes')
                  ->references('idfacultes')->on('facultes');
            $table->foreign('idpromotions')
                  ->references('idpromotions')->on('promotions');

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
        Schema::dropIfExists('auditoires');
    }
}
