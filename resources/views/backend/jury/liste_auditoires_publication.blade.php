@extends('backend.layouts.master',['title'=>'Publication'])
@include('backend.partials.includes.dataTables.dataTables')
@include('backend.partials.includes.dataTables.buttons')
@push('stylesheets')
@endpush

@section('container')

<div class="create">

	<button type="button" id="addPublication" class="btn btn-info btn-bg" data-toggle="modal" data-target="#exampleModalCenter"><span class="fa fa-plus"> </span> <span class="h4">Publier</span>
	</button>
</div>
<br>
<div>
	{!!$dataTable->table() !!}	
</div>
{{-- Modal Ajout Publication --}}

@include('backend.partials.includes.formulaires.publicationForm')

@stop

@push("scripts")
{!!$dataTable->scripts() !!}
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

@endpush