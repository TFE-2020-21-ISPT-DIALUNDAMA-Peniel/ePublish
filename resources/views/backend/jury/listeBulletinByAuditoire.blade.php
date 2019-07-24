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
<nav>
  <div class="nav nav-tabs text-dark" id="nav-tab" role="tablist">
    <a class="nav-item nav-link text-dark" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">AFFICHER LES BULLETINS</a>
    <a class="nav-item nav-link active text-dark" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">IMPORTER LES BULLETINS</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<div class="card-body" id="bulletinUpload">
	   {{-- upload de bulletin --}}
		@include('backend.partials.includes.uploadFileBootstrap.upload-file-bootstrap',['annee'=>$annee,'session'=>$session,'auditoire'=>$auditoire])
	</div>
  	
  	
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<div class="card-body">
		{!!$dataTable->table() !!}
  	</div>
  </div>
</div>




{{-- Modal affichage bullettin --}}

<!-- Modal -->
<div class="modal fade" id="showBulletin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modifier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body">
      	{{-- <img class="bullettinImg" id="modal-bulletin-img" > --}}
      	<div class="img-fluid" id="imgViewBulletin">
      		
      	</div>
      </div>
     {{--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="save btn btn-primary">Modifier</button>
      </div> --}}
      </div>
    </div>
</div>

{{-- Modal Publication--}}

@include('backend.partials.includes.formulaires.publicationForm',['idauditoireSelected'=>$auditoire->idauditoires])


@stop

@push('scripts')

{!!$dataTable->scripts() !!}

<script type="text/javascript">
		$(document).on('click', '.showBulletin', function() {
		   var data = $(this).attr('data-info');
		   // $('#modal-bulletin-img').attr('scr',data);
			$.ajax({
				type: 'post',
				url: '{{ route('jury.showBulletinImg') }}',
				data: {
					'_token': $('input[name=_token]').val(),
					'idbulletins': data,
					},

				success: function(data) {
					$('#imgViewBulletin').html(data)
				},

		        error:function(data) {
			        $('#imgViewBulletin').html('une erreur est survenue')
			    }
			});
		});

		$(document).on('click', '.uploadBulletin', function() {
		  	$('#UploadBulletin').addClass('show');
		});

</script>

@endpush 

