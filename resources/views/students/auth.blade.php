@extends('layouts.master',['title'=>'Authentification'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop
@section('container')
<div class="container mx-auto xs" id="container" >

	<div class="card text-center bg-transparent border-primary">
	  <div class="card-header ">
	    <h4>Autentification</h4>
	  </div>
	  <div class="card-body">			
	    {{-- <h5 class="card-title">Special title treatment</h5> --}}
				{{-- msg-flash --}}
				@include('partials._msgFlash')
		<form    method= 'post' action="" class="form">
			@csrf
	        <div class='form-group' >
	        	<input type='text' id='name' name='name' class='form-control' placeholder="Nom ou Matricule" required='required'>
	        </div>
	        <div class='form-group' >
	            <input type='text' id='code' name='code' class='form-control code' placeholder="Code d'accès" required='required' >
	        </div>
	        <div class='form-group' >  
	           <input type='submit' class='btn btn-primary btn-block' name='submit' value="Valider">        
	        </div>
		</form>		
			</div>
	  <div class="card-footer text-muted">
	    &copy 
	  </div>
	</div>
</div>
@stop 