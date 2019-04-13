@extends('backend.layouts.master') 
@section('stylesheet')

{{-- DataTable --}}
<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/datatables.min.css') }}" rel="stylesheet">


<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">

<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">

@stop

@section('container')  

{!! $dataTable->table(['class' => 'table table-bordered ']); !!}

@stop
@section('script')

<script src={{ asset('backend/assets/libs/datatables.net-bs4/js/datatables.min.js') }}></script> 
{!! $dataTable->scripts(); !!}


@stop