
		@foreach (App\Models\Auditoire::getAuditoireGroupBySection() as $section)
		<div class="accordion" id="accordionExample">
			<div class="card m-b-0">
			    <div class="card-header" id="headingOne">
			      <h5 class="mb-0">
			        <a data-toggle="collapse" data-target="#{{ $section[0]->section_lib }}" aria-expanded="false" aria-controls="{{ $section[0]->section_lib }}" class="collapsed">
			            {{-- <i class="m-r-5 fa fa-magnet" aria-hidden="true"></i> --}}
			            <span>SECTION : {{ $section[0]->section_lib }}</span>
			        </a>
			      </h5>
			    </div>
			    <div id="{{ $section[0]->section_lib }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
			      <div class="card-body">
			        <ul class="list-style">
			        	@foreach ($section as $auditoire)
			        	<a href="{{ $route .'/auditoire/'.$auditoire->idauditoires }}" class="text-body" >
			        		<li> {{ $auditoire->lib }}</li>
			        	</a>
			        	@endforeach
			        </ul>
			      </div>
			    </div>
			</div>
		</div>
		@endforeach