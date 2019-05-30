@extends('backend.layouts.master',['title'=>'Forcer la publication'])
@push('stylesheets')
@endpush

@section('container')
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">Attention</h4>
	  <p>{!! $message !!}</p>
	  <hr>
	  <p class="mb-0">
	  	<a href="{{ $routeAjoutBulletin }}" class="btn btn-success">Ajouter des bulletins</a>

	  	<button  onclick="getElementById('form-force-publication').submit()" class="btn btn-danger">Forcer la publication</button>
	  </p>
	</div>


	<form action="{{ route('jury.publish') }}" id="form-force-publication" method="post" hidden="true">
  		@csrf 
  		<input  name="idsessions" value="{{ $data['idsessions'] }}">
  		<input  name="idauditoires" value="{{ $data['idauditoires'] }}">
  		<input  name="mode_publication" value="{{ $data['mode_publication'] }}">
  		<input  name="date_publication" value="{{ $data['date_publication'] }}">
  		<input  name="force_publication" value="true">
  	</form>
@stop

@push("scripts")
@endpush