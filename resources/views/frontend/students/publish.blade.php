
{{-- On affiche le fichier pdf en plein écran --}}
{{-- <object data="{{ asset('stock/pdf.pdf') }}" type="application/pdf" width="100%" height="100%" style="height: 1200px">
	@extends('layouts.master',['title'=>'Publish'])	
	@section('container')
		<a href="#" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20%"> Télécharger </a>
	@stop
</object> --}}	


@php
	
@endphp
@extends('frontend.layouts.master',['title'=>'Bulletin'])	
@section('container')
<div class="card container bg-light">
  <div class="card-header">

    	Matricule:  {{ session('student')->matricule }} <br>
    	

  </div>
  <div class="fluid">
    <img src="{{ route('viewBulletin',$bulletin->file)}}" class="img-fluid" alt="{{ session('student')->nom }}">
  </div>
  <div class="card-footer text-muted">
		<a href="{{ route('dowloadBulletin',$bulletin->file)}}" class="btn btn-primary btn-lg btn-block"> Télécharger </a>
    <hr>
    <a href="{{ route('welcome.index') }} " class="btn btn-danger btn-block"> Fermer </a>
  </div>
  @include('partials._@kindev')
</div>
@stop


