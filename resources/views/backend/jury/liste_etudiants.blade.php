@extends('backend.layouts.master')
@include('backend.partials.includes.dataTables.dataTables')
@include('backend.partials.includes.dataTables.buttons')

@section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">
<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
@stop

@section('container')
	{!!$dataTable->table() !!}







<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



























@stop

@push('scripts')

	{!!$dataTable->scripts() !!}
	{{-- <script src={{ asset('js/bootstrap4-toggle.min.js') }}></script> --}}
<script type="text/javascript">
	$(document).on('click', '.edit-modal', function() {
			$('#footer_action_button').text(" Update");
			$('#footer_action_button').addClass('fa fa-check');
			$('#footer_action_button').removeClass('fa fa-trash');
			$('.actionBtn').addClass('btn-success');
			$('.actionBtn').removeClass('btn-danger');
			$('.actionBtn').removeClass('delete');
			$('.actionBtn').addClass('edit');
			$('.modal-title').text('Edit');
			$('.deleteContent').hide();
			$('.form-horizontal').show();
			var stuff = $(this).data('info').split(',');
			fillmodalData(stuff)
			$('#myModal').modal('show');
			});

	function fillmodalData(details){
			$('#fid').val(details[0]);
			$('#fname').val(details[1]);
			$('#lname').val(details[2]);
			$('#email').val(details[3]);
			// $('#gender').val(details[4]);
			// $('#country').val(details[5]);
			// $('#salary').val(details[6]);
			}



	$('.modal-footer').on('click', '.edit', function() {
$.ajax({
	type: 'post',
	url: '/editItem',
	data: {
		'_token': $('input[name=_token]').val(),
		'id': $("#fid").val(),
		'fname': $('#fname').val(),
		'lname': $('#lname').val(),
		'email': $('#email').val(),
		// 'gender': $('#gender').val(),
		// 'country': $('#country').val(),
		// 'salary': $('#salary').val()
		},
	success: function(data) {
		if (data.errors){
			$('#myModal').modal('show');
		if(data.errors.fname) {
			$('.fname_error').removeClass('hidden');
			$('.fname_error').text("First namecan't be empty !");
		}
		if(data.errors.lname) {
			$('.lname_error').removeClass('hidden');
			$('.lname_error').text("Last namecan't be empty !");
		}
		if(data.errors.email) {
			$('.email_error').removeClass('hidden');
			$('.email_error').text("Email mustbe a valid one !");
		}
		// if(data.errors.country) {
		// 	$('.country_error').removeClass('hidden');
		// 	$('.country_error').text("Countrymust be a valid one !");
		// }
		// if(data.errors.salary) {
		// 	$('.salary_error').removeClass('hidden');
		// 	$('.salary_error').text("Salary mustbe a valid format ! (ex: #.##)");
		// 	}
		}
		else {
			$('.error').addClass('hidden');
			$('.item' + data.id).replaceWith("<trclass='item" + data.id + "'><td>" +data.id + "</td><td>" +data.first_name +
			"</td><td>" + data.last_name + "</td><td>" + data.email + "</td><td>" +data.gender + "</td><td>" +data.country + "</td><td>" + data.salary +"</td><td><button class='edit-modal btn btn-info' data-info='" +data.id+","+data.first_name+","+data.last_name+","+data.email+","+"' ><spanclass='fa fa-trash'></span> Delete</button></td></tr>");
			}}
	});
});

</script>

@endpush 

