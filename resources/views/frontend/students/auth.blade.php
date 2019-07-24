@extends('frontend.layouts.master',['title'=>'Authentification'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/font-awesome.css') }}">

@stop
@section('container')
@include('frontend.students.includes.auth_form')
   
@stop

@section('script')
 {{-- <script type="text/javascript">
    $(function(){
      $(document).on('submit', '#form', function(e) {
        e.preventDefault();
        ajaxBox_loader(true)
        $('#msgErrors').attr('hidden','true');
        $.ajax({
          method: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),
          global: true,
          
          complete : function(){
              ajaxBox_loader(false)
          },
          success :function(data) {
          // location = data;
          $('html').html(data);
          },
          error:function(data) {
          var errors = data.responseJSON.errors;
            $.each(errors, function (key, value) {
              $('#msgErrors .msgErrors').html(value);
              $('#msgErrors').removeAttr('hidden');
            });
          }

        });
      $('#formulaire').ajaxStart(function(){
        alert('a'); 
      });

    });
  });

 </script>
 --}}
@stop
