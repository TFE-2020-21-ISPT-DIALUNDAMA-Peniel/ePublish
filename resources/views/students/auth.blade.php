@extends('layouts.master',['title'=>'Authentification'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/font-awesome.css') }}">

@stop
@section('container')
    <form class="form-signin" method="post" id='form' data-parsley-validate>
      <div class="text-center mb-4">
  @include('partials._logoIspt')
        <h1 class="h3 mb-3 font-weight-normal">Authentification</h1>
        <p>
        	<a data-toggle="collapse" href="#authDoc" role="button" aria-expanded="false" aria-controls="authDoc"><h3><span class="fa fa-question-circle"></span></h3></a>
        	<div class="collapse" id="authDoc">
			  <div class="card card-body alert alert-info">
			     l'authentification vous permet d'avoir accès à votre relevé de côte moyennant votre Nom ou votre Matricule et un code d'accès qui vous a été fourni par votre section.
			  </div>
			</div>    
    	 </p>
      </div>
	@include('partials._msgFlash')
	@csrf
      <div class="form-label-group">
        <input type="input" name="name" value="{{ old('name') }}"  maxlength="45" id="inputName" class="form-control" placeholder="Nom ou Matricule" required autofocus>
        <label for="inputName">Nom ou Matricule</label>
      </div>

      <div class="form-label-group input-group">
        <input type='password' id='inputCode' name='code' maxlength="10" autocomplete="off" class='form-control' placeholder="Code d'accès" data-toggle="password" required>
        <label for="inputCode">Code d'accès</label>
       <div class="input-group-append">
          <span class="input-group-text"><i class="fa fa-eye"></i></span>
        </div>
      </div>

      <div class="checkbox mb-3">
        <label>
          <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Je n'ai pas un code d'accès</a>
        </label>
		<div class="collapse" id="collapseExample">
		  <div class="card card-body alert alert-warning">
		    Si vous n'avez pas un code d'accès, veillez en procurer auprès de votre section.
		  </div>
		</div>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
       @include('partials.@copyrith')
    </form>
@stop

@section('script')
  <script type="text/javascript">
    !function ($) {
    //eyeOpenClass: 'fa-eye',
    //eyeCloseClass: 'fa-eye-slash',
        'use strict';

        $(function () {
            $('[data-toggle="password"]').each(function () {
                var input = $(this);
                var eye_btn = $(this).parent().find('.input-group-text');
                eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
                eye_btn.on('click', function () {
                    if (eye_btn.hasClass('input-password-hide')) {
                        eye_btn.removeClass('input-password-hide').addClass('input-password-show');
                        eye_btn.find('.fa').removeClass('fa-eye').addClass('fa-eye-slash')
                        input.attr('type', 'text');
                    } else {
                        eye_btn.removeClass('input-password-show').addClass('input-password-hide');
                        eye_btn.find('.fa').removeClass('fa-eye-slash').addClass('fa-eye')
                        input.attr('type', 'password');
                    }
                });
            });
        });

    }(window.jQuery);
  </script>

  <script type="text/javascript" src="{{  asset('js/appForm.js')  }}"></script>

@stop
