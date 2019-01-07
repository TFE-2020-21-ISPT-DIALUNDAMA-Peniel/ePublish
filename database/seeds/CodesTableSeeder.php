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
        	for ($i=1; $i < 5 ; $i++) { 
	        	DB::table('codes')->insert([
	        		'code' => getUniqueCode(),
	        		'matricule_etudiant' => $etudiant->matricule,
	        		'idsessions' => $i,
	        		'idauditoires' => $etudiant->idauditoires,
	        		'idsections' => $etudiant->idsections, 
	        		'active' => 0,
	        		'statut' => 0,
	        	]);
        	}
        }
    }
}
