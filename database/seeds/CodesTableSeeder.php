<?php

use Illuminate\Database\Seeder;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etudiants = DB::table('etudiants')->get();
        foreach ($etudiants as $etudiant) {
        	for ($i=1; $i < 3 ; $i++) { 
	        	DB::table('codes')->insert([
	        		'code' => getUniqueCode(),
	        		'idetudiants' => $etudiant->idetudiants,
	        		'idsessions' => $i,
	        		'active' => 0,
	        		'statut' => 0,
	        	]);
        	}
        }
    }
}
