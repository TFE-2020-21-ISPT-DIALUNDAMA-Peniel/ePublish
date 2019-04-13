@push('stylesheets')
    {{-- <link href="{{ asset('dataTables/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('dataTables/buttons/css/buttons.dataTables.min.css') }}" rel="stylesheet">

@endpush

@push('scripts')
    <!-- Script buttons DataTables -->
{{-- 	<script type="text/javascript" src="{{ asset('dataTables/buttons/js/dataTables.buttons.min.js') }}"></script>	
	<script type="text/javascript" src="{{ asset('dataTables/buttons/js/buttons.print.min.js') }}"></script>	
	<script type="text/javascript" src="{{ asset('dataTables/buttons/js/buttons.bootstrap4.min.js') }}"></script>	



	<script type="text/javascript" src="{{ asset('dataTables/buttons/js/buttons.flash.min.js') }}"></script>	
	<script type="text/javascript" src="{{ asset('dataTables/buttons/js/buttons.html5.min.js') }}"></script>	
	<script type="text/javascript" src="{{ asset('dataTables/buttons/js/buttons.jqueryui.min.js') }}"></script>	 --}}
	<script type="text/javascript" src="{{ asset('dataTables/datatables.min.js') }}"></script>	 --}}




@endpush	