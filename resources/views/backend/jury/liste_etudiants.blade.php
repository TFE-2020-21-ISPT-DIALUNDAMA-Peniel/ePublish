@extends('backend.layouts.master')
@include('backend.partials.includes.dataTables.dataTables')
@include('backend.partials.includes.dataTables.buttons')

@section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">
<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
@stop

@section('container')
<div class="card-title">
	<h5>{{ strtoupper($auditoire->lib) }}</h5>
	<hr>
</div>
<div class="create">
	<button type="button" class="addModal btn btn-info" data-toggle="modal" data-target="#editModal">
  		 <span class="fa fa-plus"> </span> Ajouter un étudiant
	</button>
</div>
	{!!$dataTable->table() !!}






{{-- Modal Formulaire ajout Etudiant --}}
@include('backend.partials.includes.formulaires.ajoutEtudiantForm',['idauditoireSelected'=>$auditoire->idauditoires])





@stop

@push('scripts')

	{!!$dataTable->scripts() !!}
	{{-- <script src={{ asset('js/bootstrap4-toggle.min.js') }}></script> --}}
<script type="text/javascript">
	
	{{-- Ajout étudiant formulaire --}}
	$(document).on('click', '.addModal', function() {
	    $('#msgErrors').html('');
  		$('#msgErrors').attr('hidden','true');

		$('.modal-title').text('Ajouter');
		// resetmodalData()
		$('.form-horizontal').trigger("reset");
		$('.form-horizontal').show();
		$('#myModal').modal('show');
		});

	{{-- edition du formulaire --}}
	$(document).on('click', '.edit-modal', function() {
		    $('#msgErrors').html('');
      		$('#msgErrors').attr('hidden','true');

			$('#footer_action_button').text(" Update");
			$('#footer_action_button').addClass('fas fa-check');
			$('#footer_action_button').removeClass('fas fa-trash');
			$('.actionBtn').addClass('btn-success');
			$('.actionBtn').removeClass('btn-danger');
			$('.actionBtn').removeClass('delete');
			$('.actionBtn').addClass('edit');
			$('.modal-title').text('Modifier');
			$('.deleteContent').hide();
			$('.form-horizontal').show();
			var stuff = $(this).data('info').split(',');
			fillmodalData(stuff)
			$('#myModal').modal('show');
			});

	// remplissage formulaire par les donnée d'une ligne selectionée
	function fillmodalData(details){
			$('#fidetudiants').val(details[0]);
			$('#fmatricule').val(details[1]);
			$('#fnom').val(details[2]);
			$('#fpostnom').val(details[3]);
			$('#fprenom').val(details[4]);
			$('#fidauditoires').val(details[5]);
			// $('#fidauditoires').val(details[4]);
			// $('#gender').val(details[4]);
			// $('#country').val(details[5]);
			// $('#salary').val(details[6]);
			}

	function resetmodalData(){
			$('#fidetudiants').val('');
			$('#fmatricule').val('');
			$('#fnom').val('');
			$('#fpostnom').val('');
			$('#fprenom').val('');
			// $('#fidauditoires').val('');
			// $('#gender').val(details[4]);
			// $('#country').val(details[5]);
			// $('#salary').val(details[6]);
			}



	$('#etudiantForm').on('submit', function(e) {
		e.preventDefault();
		$('#msgErrors').html('');
      	$('#msgErrors').attr('hidden','true');

		$.ajax({
			type: 'post',
			url: '{{ route('jury.etudiant.store') }}',
			data: {
				'_token': $('input[name=_token]').val(),
				'idetudiants': $("#fidetudiants").val(),
				'matricule': $("#fmatricule").val(),
				'nom': $('#fnom').val(),
				'postnom': $('#fpostnom').val(),
				'postnom': $('#fprenom').val(),
				'idauditoires': $('#fidauditoires').val(),
				// 'gender': $('#gender').val(),
				// 'country': $('#country').val(),	
				// 'salary': $('#salary').val()
				},

			success: function(data) {
				$('#editModal').modal('hide');
				flashy('Etudiant OK!!!!','#');
				// on actualise la ligne
				$('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +data.id + "</td><td>" +data.first_name +
					"</td><td>" + data.last_name + "</td><td>" + data.email + "</td><td>" +data.gender + "</td><td>" +data.country + "</td><td>" + data.salary +"</td><td><button class='edit-modal btn btn-info' data-info='" +data.id+","+data.first_name+","+data.last_name+","+data.email+","+"' ><spanclass='fa fa-trash'></span> Delete</button></td></tr>");
			},

	        error:function(data) {
		        var errors = data.responseJSON.errors;
		          $.each(errors, function (key, value) {
		          	document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
		            $('#msgErrors').removeAttr('hidden');
		        });
		    }
		});
	});

	{{-- Suppression  --}}
	$(document).on('click', '.delete-modal', function() {
		$('#footer_action_button').text(" Delete");
		$('#footer_action_button').removeClass('glyphicon-check');
		$('#footer_action_button').addClass('glyphicon-trash');
		$('.actionBtn').removeClass('btn-success');
		$('.actionBtn').addClass('btn-danger');
		$('.actionBtn').removeClass('edit');
		$('.actionBtn').addClass('delete');
		$('.modal-title').text('Delete');
		$('.deleteContent').show();
		$('.form-horizontal').hide();
		var stuff = $(this).data('info').split(',');
		$('.did').text(stuff[0]);
		$('.dname').html(stuff[1] +" "+stuff[2]);
		$('#myModal').modal('show');
	});

</script>

@endpush 

