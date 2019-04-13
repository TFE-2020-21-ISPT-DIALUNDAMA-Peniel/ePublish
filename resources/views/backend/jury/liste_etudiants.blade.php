@extends('backend.layouts.master')
@include('backend.partials.includes.dataTables.dataTables')
@include('backend.partials.includes.dataTables.buttons')

@section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">
<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
@stop

@section('container')
	{!!$dataTable->table() !!}
@stop

@push('scripts')
	
	{!!$dataTable->scripts() !!}
	{{-- <script src={{ asset('js/bootstrap4-toggle.min.js') }}></script> --}}

@endpush 

