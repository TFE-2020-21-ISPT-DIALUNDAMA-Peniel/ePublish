
@extends('backend.layouts.master',['title'=>'Auditoires'])
@push('stylesheets')
@endpush

@section('container')
<div class="create">
	<button type="button" class="addModal btn btn-info" data-toggle="modal" data-target="#editModal">
  		 <span class="fa fa-plus"> </span> Ajouter un étudiant
	</button>
</div>
<br><br><br>
<div class="row">
	<div class="col-12">
	@include('backend.partials.includes.liste_auditoire',['route' => $route])
	</div>
	<div class="col-9">
		{{-- {!!$dataTable->table() !!}	 --}}
	</div>
</div>
{{-- Modal Formulaire ajout Etudiant --}}
@include('backend.partials.includes.formulaires.ajoutEtudiantForm')



@stop

@push("scripts")
{{-- {!!$dataTable->scripts() !!} --}}
@endpush