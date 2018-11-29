
{{-- On affiche le fichier pdf en plein écran --}}
<object data="{{ asset('stock/pdf.pdf') }}" type="application/pdf" width="100%" height="100%" style="height: 1200px">
	@extends('layouts.master',['title'=>'Publish'])	
	@section('container')
		<a href="#" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20%"> Télécharger </a>
	@stop
</object>	
