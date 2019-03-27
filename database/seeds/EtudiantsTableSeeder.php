<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class EtudiantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run(Faker $faker)
    {

		$auditoires = DB::table('auditoires')->get();
		foreach ($auditoires as $auditoire) {
			$nbr = random_int(25, 100);
			for ($i=0; $i < $nbr ; $i++) {
				DB::table('etudiants')->insert([
					'matricule' => getUniqueMatricule(),
			        'nom'	=> $faker->lastName(),
			        'postnom' => $faker->lastName(),
			        'prenom' => $faker->firstName(),
			        'idauditoires' => $auditoire->idauditoires,
			        'annee_acad' => 1,
			        'statut' => 1,
				
				]);
			}

		}     
    }
}
