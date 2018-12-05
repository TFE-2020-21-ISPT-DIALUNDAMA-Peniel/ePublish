@extends('layouts.master',['title'=>'Bienvenu(e)'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop

@section('container')
    <form class="form-signin" method= 'post'>
      <div class="text-center mb-4">
  @include('partials._logoIspt')
        <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name') }}</h1>
        <p>{{config('app.name') }} est une plateforme de publication des résultats, qui vous permet de consulter vos rélèvés des côtes en ligne.
        </p>
      </div>
      @include('partials._msgFlash')
      @csrf
      <div class="form-label-group">
		<select class="custom-select form-control" name="session" id="sessionId" required="required" >
	    	@foreach ($sessions as $session)
	    		<option value="{{ $session->idsessions }}">{{ $session->abbr }}</option>
	    	@endforeach
    	</select>
      </div>

      <div class="form-label-group">
		<select class="custom-select" name="annee" id="annee" required="required" >
    		@foreach ($annees as $annee)
    			<option value="{{ $annee->idgestion_annees }}">{{ $annee->annee_format }}</option>
    		@endforeach
    	</select>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
     @include('partials.@copyrith')
    </form>
@stop

