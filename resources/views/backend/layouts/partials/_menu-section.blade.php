{{-- MENU POUR L'INTERFACE SECTION --}}
 @inject('session', 'App\Models\Session')
<?php $session = $session->get() ?>
 @if (session('user')['role'] == 'section')
 <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Sessions </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
    	@foreach ($session as $s)
       		 <li class="sidebar-item">
       		 	<a href="{{ route('section.show',$s->idsessions) }}" class="sidebar-link">
       		 		<i class="mdi mdi-note-outline"></i>
       		 		<span class="hide-menu"> 
       		 			{{ ucfirst($s->abbr) }} 
       		 		</span>
       		 	</a>
       		 </li>
    	@endforeach
    </ul>
</li>

 @endif

 {{-- MENU POUR L'INTERFACE JURY --}}
 @if (session('user')['role'] == 'jury')
<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Publications </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
      @foreach ($session as $s)
           <li class="sidebar-item">
            <a href="{{ route('jury.getPublicationBySession',$s->idsessions) }}" class="sidebar-link">
              <i class="mdi mdi-note-outline"></i>
              <span class="hide-menu"> 
                {{ ucfirst($s->abbr) }} 
              </span>
            </a>
           </li>
      @endforeach
    </ul>
</li>
<li class="sidebar-item">
 <a href="{{ route('jury.showAuditoires') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Etudiants</span></a>
</li>
 
<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Bulletins </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
    	@foreach ($session as $s)
       		 <li class="sidebar-item">
       		 	<a href="{{ route('jury.getBulletinBySession',$s->idsessions) }}" class="sidebar-link">
       		 		<i class="mdi mdi-note-outline"></i>
       		 		<span class="hide-menu"> 
       		 			{{ ucfirst($s->abbr) }} 
       		 		</span>
       		 	</a>
       		 </li>
    	@endforeach
    </ul>
</li>

<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Palmarès </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
      @foreach ($session as $s)
           <li class="sidebar-item">
            <a href="{{ route('jury.getBulletinBySession',$s->idsessions) }}" class="sidebar-link">
              <i class="mdi mdi-note-outline"></i>
              <span class="hide-menu"> 
                {{ ucfirst($s->abbr) }} 
              </span>
            </a>
           </li>
      @endforeach
    </ul>
</li>
 @endif