@extends('layouts.master',['title'=>'Authentification'])
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop
@section('container')
<div class="container" >
	<div class="panel panel-default row justify-content-center ">
		<div class="col-xs-8 col-sm-10" id="formAuthStud">
		<div class="panel-heading">
			<h3 class="panel-title" style="text-align: center;">
				<img class="img-fluid" src="{{ asset('img/logo.png') }}">
			</h3>
		</div>	
			<div class="panel-body">	
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
		</div>
	</div>
</div>
@stop 
