@extends('backend.layouts.master')
@include('backend.partials.includes.dataTables.dataTables')
@include('backend.partials.includes.dataTables.buttons')

@section('stylesheet')

@stop

@section('container')
	<div class="card">
		<div class="card-body row">
			<div class="col-8">
				<h5 class="card-title m-b-0">{{ $session->lib ." | ".$auditoire->lib }}</h5>
			</div>
			<div class="col-4 ml-auto text-right">
				{!! $btn !!}
			</div>
			
		</div>
	</div>
	<div class="card-body" id="bulletinUpload">
	{{-- upload de bulletin --}}
	@include('backend.partials.includes.uploadFileBootstrap.upload-file-bootstrap',['annee'=>$annee,'session'=>$session,'auditoire'=>$auditoire])
	</div>
@stop

@push('scripts')



@endpush 

