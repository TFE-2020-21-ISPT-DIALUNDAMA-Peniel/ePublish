<?php 

namespace App\Utilities\Html;


class Html 
{
	
	public static function getStudentListTable(array $dataEtudiants){

		if (is_array($dataEtudiants)){
		  	if(!empty($dataEtudiants)) {
				foreach ($dataEtudiants as $etudiant) {
					$html = " <tr role='row' class='odd' id='etudiant' data-student >
	                      <th  scope='row' data-toggle='modal' data-target='#Modal2' style='font-size: 1rem;'>$etudiant['matricule']</th>
	                      <td data-toggle='modal' data-target='#Modal2'>$etudiant['nom']</td>
	                      <td data-toggle='modal' data-target='#Modal2'>$etudiant['postnom']   $etudiant['prenom'] </td>
	                      <td data-toggle='modal' data-target='#Modal2' >$etudiant['code']</td>
	                      <td ><a href='route('section.code_activated', $etudiant['idcode'] )' >$etudiant['codeIsActive']</a></td>
	                      <td data-toggle='modal' data-target='#Modal2' id = 'codeStatut' data-codeStatut ='$etudiant['codeStatut']'>$etudiant['codeStatut']</td>
	                      <td style='display: none;'> route('section.code_activated', $etudiant['idcode'] )</td>
	                   </tr>";
				}
			$html= "<td colspan='6' style='text-align: center;'><strong >Aucun Etudiant trouvé</strong></td>";
			}
		}
		// @if ($dataEtudiants->isNotEmpty())
  //                   @foreach ($dataEtudiants as $etudiant)
  //                   <tr role="row" class="odd" id="etudiant" data-student >
  //                     <th  scope="row" data-toggle="modal" data-target="#Modal2" style="font-size: 1rem;">{{ $etudiant['matricule'] }}</th>
  //                     <td data-toggle="modal" data-target="#Modal2">{{ $etudiant['nom'] }}</td>
  //                     <td data-toggle="modal" data-target="#Modal2">{{ $etudiant['postnom'] }}  {{ $etudiant['prenom'] }}</td>
  //                     <td data-toggle="modal" data-target="#Modal2" >{{ $etudiant['code'] }}</td>
  //                     <td ><a href="{{ route('section.code_activated', $etudiant['idcode'] ) }}" >{{ $etudiant['codeIsActive'] }}</a></td>
  //                     <td data-toggle="modal" data-target="#Modal2" id = "codeStatut" data-codeStatut ="{{ $etudiant['codeStatut'] }}">{{ $etudiant['codeStatut'] }}</td>
  //                     <td style="display: none;">{{ route('section.code_activated', $etudiant['idcode'] ) }}</td>
  //                  </tr>
  //                   @endforeach     
  //                   @else
  //                     <td colspan='6' style="text-align: center;"><strong >Aucun Etudiant trouvé</strong></td>
  //                   @endif
	}
}