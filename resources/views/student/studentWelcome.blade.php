@extends('layouts.master',['title'=>'Bienvenu(e)'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop
@section('container')
<div class="container" >
	<div class="panel panel-default row justify-content-center ">
		<div class="col-xs-8 col-sm-10" id="formSession">
		<div class="panel-heading">
			<h3 class="panel-title" style="text-align: center;">
				<img class="img-fluid" src="{{ asset('img/logo.png') }}">
			</h3>
		</div>	
			<div class="panel-body">			
				<form    method= 'post' action="" class="form">
					@csrf
					<div class="row">
						<div class="form-group col-md-8 col-xs-8">
					        <select class="form-control" name="session" id="sessionId" required="required" >
					        	<option>1ère Session</option>
					        </select>
						</div>
						<div class="form-group col-md-4 col-xs-4">
							<select class="form-control" name="annee" id="annee" required="required" >
				        		<option>2019</option>
				        	</select>
						</div>
				       
				        <div class='form-group col-md-12'>  
				           <input type='submit' class='btn btn-primary btn-block' name='submit' value="Valider">        
				        </div>
					</div>
			      </form>			
			</div>
		</div>
	</div>

</div>
@stop 