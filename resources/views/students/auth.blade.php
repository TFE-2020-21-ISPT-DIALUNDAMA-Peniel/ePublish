@extends('layouts.master',['title'=>'Authentification'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop
@section('container')
    <form class="form-signin" method="post">
      <div class="text-center mb-4">
        <img class="mb-4" src="{{ asset('img/logoIspt.png') }}" alt="" width="90" height="90">
        <h1 class="h3 mb-3 font-weight-normal">Authentification</h1>
        <p>
        	<a data-toggle="collapse" href="#authDoc" role="button" aria-expanded="false" aria-controls="authDoc"><h1>?</h1></a>
        	<div class="collapse" id="authDoc">
			  <div class="card card-body alert alert-info">
			     l'authentification vous permet d'avoir accès à votre rélèvé de côte moyennant votre Nom ou votre Matricule et un code d'accès qui vous a été fourni par votre section.
			  </div>
			</div>    
    	 </p>
      </div>
	@include('partials._msgFlash')
	@csrf
      <div class="form-label-group">
        <input type="input" name="name" id="inputName" class="form-control" placeholder="Nom ou Matricule" required autofocus>
        <label for="inputName">Nom ou Matricule</label>
      </div>

      <div class="form-label-group">
        <input type='text' id='inputCode' name='code' class='form-control' placeholder="Code d'accès" required>
        <label for="inputCode">Code d'accès</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Je n'ai pas un code d'accès</a>
        </label>
		<div class="collapse" id="collapseExample">
		  <div class="card card-body alert alert-warning">
		    Si vous n'avez pas de code d'accès, veillez contacter votre section.
		  </div>
		</div>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018 | KinDev</p>
    </form>

@stop