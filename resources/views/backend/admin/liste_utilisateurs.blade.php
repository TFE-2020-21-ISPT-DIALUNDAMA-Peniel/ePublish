@extends('backend.layouts.master')
@include('backend.partials.includes.dataTables.dataTables')
@include('backend.partials.includes.dataTables.buttons')

{{-- @section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">
<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
@stop --}}

@section('container')
<div class="create">
	<button type="button" class="addModal btn btn-info" data-toggle="modal" data-target="#editModal">
  		 <span class="fa fa-plus"> </span> Ajouter un utilisateur
	</button>
</div>
<br><br>
	{!!$dataTable->table() !!}

{{-- Modal Formulaire ajout Etudiant --}}
@include('backend.partials.includes.formulaires.ajoutUserForm')
@stop

@push('scripts')
	{!!$dataTable->scripts() !!}
@endpush 

