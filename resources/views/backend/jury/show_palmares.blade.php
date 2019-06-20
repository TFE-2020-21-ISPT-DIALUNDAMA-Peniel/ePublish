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
		</div>
		
	</div>
</div>
<nav>
  <div class="nav nav-tabs text-dark" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active text-dark" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ONT RÉUSSI</a>
    <a class="nav-item nav-link text-dark" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">AFFICHER TOUS</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<div class="card-body">
		{!! $dataTable2->table(['id'=>'dt2']) !!}
  	</div>
  	
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<div class="card-body">
  		{!! $dataTable1->table(['id'=>'dt1']) !!}
  	</div>
  </div>
</div>

@stop

@push('scripts')

{!!$dataTable1->scripts() !!}
{!!$dataTable2->scripts() !!}

<script type="text/javascript">
	$(document).on('click', '.action-add', function(e){
		e.preventDefault();
		param = $(this).data('info').split(',');
		$.ajax({
			type: 'post',
			url: '{{ route("jury.etudiant_succes") }}',
			data: {
				'_token': $('input[name=_token]').val(),
				'idetudiants': param[0],
				'idsessions': param[1],
				},

			success: function(data) {
				$('#dt1').DataTable().draw(false);
				$('#dt2').DataTable().draw(false);
				
			},

	        error:function(data) {
		        var errors = data.responseJSON.errors;
		          $.each(errors, function (key, value) {
		          	document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
		            $('#msgErrors').removeAttr('hidden');
		        });
		    }
		});
	});
</script>
<script type="text/javascript">
	$(document).on('click', '.action-del', function(e){
		e.preventDefault();
		param = $(this).data('info').split(',');
		$.ajax({
			type: 'post',
			url: '{{ route("jury.etudiant_no_succes") }}',
			data: {
				'_token': $('input[name=_token]').val(),
				'idetudiants_succes': param[0],
				},

			success: function(data) {
				$('#dt1').DataTable().draw(false);
				$('#dt2').DataTable().draw(false);
				
			},

	        error:function(data) {
		        var errors = data.responseJSON.errors;
		          $.each(errors, function (key, value) {
		          	document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
		            $('#msgErrors').removeAttr('hidden');
		        });
		    }
		});
	});
</script>
@endpush 

