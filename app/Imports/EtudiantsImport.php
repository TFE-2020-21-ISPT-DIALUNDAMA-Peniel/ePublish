<?php

namespace App\Imports;

use App\Models\Etudiant;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EtudiantsImport implements ToModel
{
    // use Importable;

    public function model(array $row)
    {
        // dd($row[0]);
        return Etudiant::updateOrCreate(
                [
                    'matricule'     => $row[0],
                    'nom'     => $row[1],

                ],
                [
                    'postnom'     => $row[2],
                    'prenom'    => $row[3],
                    'idauditoires' => 1,
                ]
            );
    }

    public function rules(): array
    {
        return [
            'matricule' => 'required|unique:etudiants',
            'nom' => 'required',

             
        ];
    }

    // /**
    //  * @return array
    //  */
    // public function customValidationMessages()
    // {
    //     return [
    //         'matricule' => 'matricule déjà enregistrer:attribute.',
    //     ];
    // }
}































// use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\Validator;
// use Maatwebsite\Excel\Concerns\ToCollection;
// // use Maatwebsite\Excel\Concerns\Importable;
// // use Maatwebsite\Excel\Concerns\WithValidation;

// class EtudiantsImport implements ToCollection
// {
//     // use Importable;
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function collection(Collection $rows)
//     {
//         // dd($rows->toArray());
//         // Validator::make($rows->toArray(), [
//         //      'matricule' => 'required',
//         //      'nom' => 'required',
//         //  ])->validate();

//         foreach ($rows as $row) {
//            Etudiant::updateOrCreate(
//                 [
//                     'matricule'=>$row[0],
//                     'nom' =>$row[1]
//                 ],
//                 [
//                     'postnom' => $row[2],
//                     'prenom' => $row[3],
//                     'idauditoires' =>1, //----En envoyer 
//                 ]
//             );
//         }
//         // return new Etudiants([
//         //     'matricule' => $row[0],
//         //     'nom' => $row[1],
//         //     'postnom' => $row[2],
//         //     'prenom' => $row[3],
//         // ]);
//     }
// }
