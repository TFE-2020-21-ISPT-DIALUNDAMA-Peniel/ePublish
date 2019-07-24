{{-- MENU POUR L'INTERFACE SECTION --}}
 @inject('session', 'App\Models\Session')
 @inject('users_roles', 'App\Models\Users_role')
<?php 
$session = $session->get(); 
$users_roles = $users_roles->get(); 
?>
 @if (session('user')['role'] == 'section')

<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" fas fa-barcode"></i><span class="hide-menu">Géstion des codes d'accès</span></a>
    <ul aria-expanded="false" class="collapse  first-level">
      @foreach ($session as $s)
           <li class="sidebar-item">
            <a href="{{ route('section.show',$s->idsessions) }}" class="sidebar-link">
              <i class="fas fa-hand-point-right"></i>
              <span class="hide-menu"> 
                {!! ucfirst($s->abbr) !!} 
              </span>
            </a>
           </li>
      @endforeach
    </ul>
</li>

 @endif

 {{-- MENU POUR L'INTERFACE ADMIN --}}
 @if (session('user')['role'] == 'admin')
 <li class="sidebar-item">
 <a href="{{ route('admin.showAuditoires') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class=" fas fa-graduation-cap"></i><span class="hide-menu">Etudiants</span></a>
</li>
{{--  <li class="sidebar-item">
 <a href="#" class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class=" fas fa-user"></i><span class="hide-menu">Utilisateurs</span></a>
</li> --}}
<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Utilisateurs </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
      @foreach ($users_roles as $role)
           <li class="sidebar-item">
            <a href="{{ route('admin.get_users',[$role->idusers_roles]) }}" class="sidebar-link">
              <i class="fas fa-hand-point-right"></i>
              <span class="hide-menu"> 
                {!! ucfirst($role->lib) !!} 
              </span>
            </a>
           </li>
      @endforeach
    </ul>
</li>

 @endif



 {{-- MENU POUR L'INTERFACE JURY --}}
 @if (session('user')['role'] == 'jury')
<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-bullhorn"></i><span class="hide-menu">Publications </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
      @foreach ($session as $s)
           <li class="sidebar-item">
            <a href="{{ route('jury.getPublicationBySession',$s->idsessions) }}" class="sidebar-link">
              <i class="fas fa-hand-point-right"></i>
              <span class="hide-menu"> 
                {!! ucfirst($s->abbr) !!} 
              </span>
            </a>
           </li>
      @endforeach
    </ul>
</li>

 
<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" fas fa-file-alt"></i><span class="hide-menu">Bulletins </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
    	@foreach ($session as $s)
       		 <li class="sidebar-item">
       		 	<a href="{{ route('jury.getBulletinBySession',$s->idsessions) }}" class="sidebar-link">
       		 		<i class="fas fa-hand-point-right"></i>
       		 		<span class="hide-menu"> 
       		 			{!! ucfirst($s->abbr) !!} 
       		 		</span>
       		 	</a>
       		 </li>
    	@endforeach
    </ul>
</li>

<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-clipboard-list"></i><span class="hide-menu">Palmarès </span></a>
    <ul aria-expanded="false" class="collapse  first-level">
      @foreach ($session as $s)
           <li class="sidebar-item">
            <a href="{{ route('jury.getPalmaresBySession',$s->idsessions) }}" class="sidebar-link">
              <i class="fas fa-hand-point-right"></i>
              <span class="hide-menu"> 
                {!! ucfirst($s->abbr) !!} 
              </span>
            </a>
           </li>
      @endforeach
    </ul>
</li>
<li class="sidebar-item">
 <a href="{{ route('jury.showAuditoires') }}" class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class=" fas fa-graduation-cap"></i><span class="hide-menu">Etudiants</span></a>
</li>
 @endif