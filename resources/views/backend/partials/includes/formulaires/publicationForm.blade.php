
@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/bootstrap-datepicker/build/css/bootstrap-datetimepicker.min.css') }}">
@endpush
<!-- Modal  Ajout Publication-->
@inject('auditoires', 'App\Models\Auditoire')

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    	<div class="modal-header">
	        <h5 class="modal-title" id="exampleModalCenterTitle">Publication</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

  		<div class="modal-body">
        {{-- Publication form --}}

        @include('frontend.partials._msgFlash')
        {{-- Formulaire --}}
	        <form id="publicationForm" action="{{ route('jury.publish') }}" method="POST" name="publicationForm" class="form-horizontal">
	                @csrf
	               <input type="hidden" name="idpublications" id="idpublications" >
	               <input type="hidden" name="idsessions" value="{{ $session->idsessions }}" required="">

	                <div class="form-group">
	                    <label for="auditoire"  class="col-sm-2 control-label">Auditoire</label>
	                    <div class="col-sm-12">
	                        <input type="text" id="fauditoires" class="form-control" disabled="" hidden="">
	                        <select class="form-control" id="fidauditoires" name="idauditoires" required="">
	                            @foreach($auditoires::getAuditoireNonPublieGroupBySection($session->idsessions) as $sections)
	                                <optgroup label="{{ $sections[0]->section_lib  }}">
	                                    @foreach ($sections as $auditoire)
	                                        @if(!empty($idauditoireSelected) && $idauditoireSelected == $auditoire->idauditoires)
	                                        <option id="auditoire-{{ $auditoire->idauditoires }}" value="{{ $auditoire->idauditoires }}" selected>{{ $auditoire->lib }}</option>
	                                        @else
	                                        <option id="auditoire-{{ $auditoire->idauditoires }}" value="{{ $auditoire->idauditoires }}"  >{{ $auditoire->lib }}</option>
	                                        @endif
	                                    @endforeach
	                                </optgroup>
	                            @endforeach
	                    	</select>
	                    </div>
	                </div>
	                <div class="form-group" id="mode_publication">
	                    <label for="auditoire"  class="col-sm-2 control-label">Publié</label>
	                    <div class="col-sm-12">
	                        {{-- <input type="text" id="auditoire" class="form-control" id="auditoire" name="auditoire" placeholder="Entrer auditoire étudiant"  maxlength="50" required="required"> --}}
	                        <select class="form-control"  name="mode_publication" required="">
	                           <option id="immediatement" value="immediatement">Immédiatement</option>
	                           <option id="planifier" value="planifier">Plannifier</option>
	                    	</select>
	                    </div>
	                </div>
	                <div class="form-group" id="date_publication" hidden="">
	                    <label for="date_publication"  class="col-sm-12 control-label">Date et Heure de publication</label>
	                	<div class="input-group col-sm-12">
	                        <input type="text" name="date_publication"  data-format="DD/MM/YYYY HH:mm" class="datapicker form-control" id="datepicker-autoclose" placeholder="jj/mm/aaaa hh:mm" autocomplete="off">
	                        {{-- <input type="datetime-local" class=" form-control" id="" placeholder="mm/dd/yyyy" min /> --}}
	                        <div class="input-group-append">
	                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
	                        </div>
	                    </div>
	                </div>
                	<div class=" col-sm-12 control-label" id="suspendre_publication_label" hidden="true">
		                <div class="col-sm-12 custom-control custom-checkbox mr-sm-2">
	                        <input type="checkbox" name="suspendre_publication" class="custom-control-input" id="suspendre_publication">
	                        <label class="custom-control-label" for="suspendre_publication"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Suspendre la publication</font></font></label>
	                    </div>
                	</div>
	                

           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
        </form>
    </div>
  	</div>

</div>


@push("scripts")
<script type="text/javascript" src="{{ asset('backend/assets/libs/bootstrap-datepicker/build/js/moment.min.js') }}"></script>	
<script type="text/javascript" src="{{ asset('backend/assets/libs/bootstrap-datepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script type="text/javascript">
	 /*datwpicker*/
        jQuery('#datepicker-autoclose').datetimepicker({
            showClose: true,
            locale : moment.locale(),
            // disabledTimeIntervals: false,
            // todayHighlight: true,
            // lang : 'fr',
            minDate : new Date(),
            format : 'DD-MM-YYYY HH:mm',
            icons: {
            	time : 'fas fa-clock',
            	date : 'fas fa-calendar-alt',
            	up : 'fas fa-chevron-up',
            	down : 'fas fa-chevron-down',
            	previous :'fas fa-chevron-left',
            	next : 'fas fa-chevron-right',
            	today : 'fas fa-crosshairs',
            	clear : 'fas fa-trash-alt',
            	close : 'fas fa-times',
            }
        });

</script>
<script type="text/javascript">
	{{-- ajout publication --}}
	$(document).on('click', '#addPublication', function() {
		    $('#suspendre_publication_label').attr('hidden',true);
			$('#fidauditoires').attr('hidden',false);
			$('#fauditoires').attr('hidden',true);
			$('#mode_publication').attr('hidden',false);
			$('#immediatement').attr('selected','selected');

      		
			});
		{{-- edition du formulaire --}}
	$(document).on('click', '.edit-modal', function() {

			$('#suspendre_publication_label').attr('hidden',false);
			$('#fidauditoires').attr('hidden',true);
			$('#fauditoires').attr('hidden',false);
			$('.form-horizontal').show();
			var stuff = $(this).data('info').split(',');
			// On determine le champ a affiché selon le statut
			// A  faire
			fillmodalData(stuff)
			$('#exampleModalCenter').modal('show');
			});

	// remplissage formulaire par les donnée d'une ligne selectionée
	function fillmodalData(details){
			$('#idpublications').val(details[0]);
			$('#fauditoires').val(details[5]);
			// $('#fidauditoires').val(details[1]);
			if ( $('#idaudi').val() != undefined) { 
				$('#idaudi').val(details[1]);
			}else{

			$('.form-horizontal').append('<input id="idaudi" name="idauditoires" value="'+details[1]+'" hidden>');
			}

			// $('#auditoire-'+details[1]).prop('selected', true);
			$('#fstatut').val(details[2]);
			$('#datepicker-autoclose').val(details[3]);
			}
</script>
	{{-- Gestion input plannification publication --}}
	<script type="text/javascript">
	if ($('#mode_publication option:selected').val() == "planifier") {
		$("#date_publication").removeAttr('hidden');
	}
	$(document).on('change', '#mode_publication', function() {
		if ($('#mode_publication option:selected').val() == "planifier") {
			$("#date_publication").removeAttr('hidden');
		}else{
			$("#date_publication").attr('hidden',true);
		}
	});
	$(document).on('change', '#suspendre_publication', function() {
		if( $('#suspendre_publication').is(':checked') ){
			$("#mode_publication").attr('hidden',true);
			$("#date_publication").attr('hidden',true);
	    	
		}else {
			$("#mode_publication").attr('hidden',false);
			if ($('#mode_publication option:selected').val() == "planifier") {
				$("#date_publication").removeAttr('hidden');
			}
		}
	});
	</script>

@endpush