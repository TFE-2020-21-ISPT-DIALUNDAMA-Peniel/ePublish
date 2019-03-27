
@extends('backend.layouts.master') 

@section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">

<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('container')  

    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>name</th>
                <th>password</th>
    
            </tr>
        </thead>

   {{--      <tbody>
        	@foreach($users as $user)
        	<tr>
        		<td>{{ $user->matricule }}</td>
        		<td>{{ $user->nom }}</td>
        		<td>{{ $user->postnom }}</td>
        		<td>{{ $user->create_at }}</td>   
        		<td>{{ $user->update_at }}</td>   	
        	</tr>         
        	@endforeach
        </tbody> --}}
    </table>

@stop


@section('script')
<script src={{ asset('backend/assets/libs/datatables.net-bs4/js/jquery.dataTables.js') }}></script>
{{-- <script src={{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap.min.js') }}></script> --}}
<script>

	
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('etudiantDataTable') !!}',
        columns: [
            { data: 'nom', name: 'nom' },
            { data: 'postnom', name: 'postnom' },

        ]
    });
});
</script>
@stop