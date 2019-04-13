{{-- MENU POUR L'INTERFACE SECTION --}}
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

 {{-- MENU POUR L'INTERFACE JURY --}}
 @if (session('user')['role'] == 'jury')
<li class="sidebar-item"> <a href="{{ route('jury.showAuditoires') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Gestions Etudiants</span></a></li>
 @endif