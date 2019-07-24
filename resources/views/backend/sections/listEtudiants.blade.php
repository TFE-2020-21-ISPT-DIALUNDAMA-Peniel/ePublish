@extends('backend.layouts.master')
@include('backend.partials.includes.dataTables.dataTables')
@include('backend.partials.includes.dataTables.buttons')

@push('stylesheets')
{{-- <link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} "> --}}
{{-- <link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet"> --}}
@endpush

@section('container')
 <div class="card">
  <div class="card-body">
      <h5 class="card-title m-b-0">{!! $session->abbr .' | '.$auditoire->lib !!}</h5>
  </div>
 </div>
 <div class="card-body">
	{!!$dataTable->table() !!}
 </div>


 {{-- Formulaire d'activation code --}}
 <form class="form-action" id="form-code-activation" action="{{ route('section.code_activated') }}" method="POST" style="display: none;" >
 	@csrf
    <input type="hidden" name="idcodes" id="fidcodes"  >
</form>
@stop

@push('scripts')

	{{-- <script src={{ asset('js/bootstrap4-toggle.min.js') }}></script> --}}
	{!!$dataTable->scripts() !!}
	<script type="text/javascript">
		$(document).on('click', '.activate-code', function() {
           
            var stuff = $(this).data('info').split(',');
            fillmodalData(stuff)
	        $.ajax({
	            type: 'post',
	            url: '{{ route('section.code_activated')  }}',
	            data: {
	                '_token': $('input[name=_token]').val(),
	                'idcodes': $("#fidcodes").val(),
	                },

	            success: function(data) {
	                $('#dataTableBuilder').DataTable().draw(false);
	                
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

    // remplissage formulaire par les donnée d'une ligne selectionée
    function fillmodalData(details){
            $('#fidcodes').val(details[0]);
            }
	</script>
@endpush 

