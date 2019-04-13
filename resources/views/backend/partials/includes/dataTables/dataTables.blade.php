@section('stylesheet')
    <link href="{{ asset('dataTables/dataTables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop

@push('scripts')

<script src={{ asset('dataTables/datatables.min.js') }}></script> 

@endpush