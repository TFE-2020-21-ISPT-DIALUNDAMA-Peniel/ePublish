@extends('frontend.layouts.master',['title'=>'Bienvenu(e)'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop

@section('container')
    <form class="form-signin" method= 'post' id='form' data-parsley-validate>
      <div class="text-center mb-4">
        @include('partials._logoIspt')
        <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name') }}</h1>
        <p>{{config('app.name') }} est une plateforme de publication <del></del> résultats, qui vous permet de consulter vos rélèvés des côtes en ligne.
        </p>
      </div>
      <div class="msg">
        <div class="alert alert-info">
          <strong>Aucun résultat disponible pour l'instant !!!</strong>
        </div>
      </div>
      @include('partials._@kindev')


      
@stop
