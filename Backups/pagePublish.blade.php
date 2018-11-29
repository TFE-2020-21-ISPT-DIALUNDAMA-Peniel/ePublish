@extends('layouts.master',['title'=>'Publication'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop
@section('container')
<div class="container mx-auto xs" id="container" >

	<div class="card text-center bg-transparent border-primary">

	  <div class="card-body">			
	  	<div id="bulletin"></div>
	  </div>
	  <div class="card-footer text-muted">
	    <a href="{{ route('publish.show',1) }}" class="btn btn-primary btn-lg">Télécharger </a> 
	  </div>
	</div>
</div>
@stop 
@section('script')
	{{-- Chargement du package PDFObjet pour la visualisation de pdf --}}
    <script src="{{ asset('js/pdfobject.min.js') }}" ></script> 
    {{-- Script pour afficher le pdf --}}
    <script type="text/javascript">
    	if(PDFObject.supportsPDFs){
			var file =$('#bulletin');
	    	var option ={
	    		height: "400px",	
	    	};
	    	PDFObject.embed("{{ Storage::url('pdf.pdf') }}",file,option); 

		}else {
			console.log("Boo, inline PDFs are not supported by this browser");
			alert('oooooooooop')
		}

    </script>
@stop 



{{-- <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div  style="width: 90%; height: 500px">
	<object data="{{ asset('stock/pdf.pdf') }}" type="application/pdf" width="100%" height="100%">
<p><b>Example fallback content</b>: This browser does not support PDFs. Please download the PDF to view it:
<a href="{{ asset('stock/pdf.pdf') }}">Download PDF</a>.</p>
</object>
</div>--}}