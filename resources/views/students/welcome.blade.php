@php
	
@endphp
@extends('layouts.master',['title'=>'Bienvenu(e)'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop
@section('container')
<div class="container mx-auto xs" id="container" >

	<div class="card text-center bg-transparent border-primary">
	  <div class="card-header ">
	    Featured
	  </div>
	  <div class="card-body">			
	    {{-- <h5 class="card-title">Special title treatment</h5> --}}
				{{-- msg-flash --}}
				@include('partials._msgFlash')
				<form    method= 'post' action="" class="form">
					@csrf
					<div class="form-group ">
				        <select class="custom-select" name="session" id="sessionId" required="required" >
				        	@foreach ($sessions as $session)
				        		<option value="{{ $session->idsessions }}">{{ $session->abbr }}</option>
				        	@endforeach
				        </select>
			        	{{-- <div class="input-group-text rounded-circle ">?</div>	 --}}

					</div>
					<div class="form-group ">
						<select class="custom-select" name="annee" id="annee" required="required" >
			        		@foreach ($annees as $annee)
			        			<option value="{{ $annee->idgestion_annees }}">{{ $annee->annee_format }}</option>
			        		@endforeach
			        	</select>
					</div>
			       
			        <div class='form-group '>  
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