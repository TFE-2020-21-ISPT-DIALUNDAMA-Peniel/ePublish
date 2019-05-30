
@extends('backend.layouts.master',['title'=>'Auditoires'])
@push('stylesheets')
@endpush

@section('container')

<div class="row">
	<div class="col-12">
	@include('backend.partials.includes.liste_auditoire',['route' => $route])
	</div>
	<div class="col-9">
		{{-- {!!$dataTable->table() !!}	 --}}
	</div>
</div>
@stop

@push("scripts")
{{-- {!!$dataTable->scripts() !!} --}}
@endpush