
 @if (session('user')['role'] == 'section')
 @inject('session', 'App\Models\Session')

 <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Sessions </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
    	@foreach ($session->get() as $s)
       		 <li class="sidebar-item"><a href="{{ route('section.show',$s->idsessions) }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> {{ ucfirst($s->lib) }} </span></a></li>
    	@endforeach
    </ul>
</li>

 @endif
