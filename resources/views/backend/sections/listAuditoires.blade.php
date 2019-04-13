@extends('backend.layouts.master') 
@include('backend.partials.includes.dataTables.dataTables')
@section('stylesheet')


{{-- <link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} "> --}}
{{-- DataTable --}}
{{-- <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/datatables.min.css') }}" rel="stylesheet">


<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">

<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet"> --}}
@stop


@section('container')  

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
          <h5 class="card-title m-b-0">Section : {{ session('user')['section'] }}</h5>
      </div>

        {!!$dataTable->table() !!}

    </div>
  </div>
</div>

<!-- BEGIN MODAL -->

<!-- END MODAL -->

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Right sidebar -->
<!-- ============================================================== -->
<!-- .right-sidebar -->
<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->



@stop
@section('script')
 {!! $dataTable->scripts() !!}
@stop