@if (session()->has('message'))
	<div class="alert alert-danger">
	 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	 	{!! session()->get('message') !!}
	</div>

@endif

@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{!! $error !!}</li>
			@endforeach
		</ul>
	</div>
@endif

<div class="alert alert-danger" id='msgErrors' hidden>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<p class="msgErrors"></p>
</div>
