 <form class="form-signin" method="post" id='form' action="{{ route('students.showBulletin') }}" data-parsley-validate>
      <div class="text-center mb-4">
        @include('partials._logoIspt')
        <h3 class="h3 mb-3 font-weight-normal">{!! $session->abbr .' | '.$auditoire->abbr !!}</h3>
        <p>
          <h5>Authentification</h5>
        </p>
        <p>
        	<a data-toggle="collapse" href="#authDoc" role="button" aria-expanded="false" aria-controls="authDoc"><h3><span class="fa fa-question-circle"></span></h3></a>
        	<div class="collapse" id="authDoc">
			  <div class="card card-body alert alert-info">
			     l'authentification vous permet d'avoir accès à votre bulletin  moyennant votre nom ou votre matricule et un code d'accès qui vous a été fourni par votre section.
			  </div>
			</div>    
    	 </p>
      </div>
  	@include('frontend.partials._msgFlash')
  	@csrf
      <div class="form-label-group">
        <input type="input" name="idsessions" value="{{ $publication->idsessions }}" hidden="">
        <input type="input" name="idauditoires" value="{{ $publication->idauditoires }}" hidden="">
        <input type="input" name="name" value="{{ old('name') }}"  maxlength="45" id="inputName" class="form-control" placeholder="Nom ou Matricule" required autofocus>
        <label for="inputName">Nom ou Matricule</label>
      </div>

      <div class="form-label-group input-group">
        <input type='password' id='inputCode' name='code' maxlength="10" autocomplete="off" class='form-control text-uppercase' placeholder="Code d'accès" data-toggle="password" required>
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
       @include('partials._@kindev')
       
    </form>

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