<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">Petey Cruiser</h4>
							<span class="mb-0 text-muted">Premium Member</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">Main</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='index') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">{{trans('mainSidebar_trans.index')}}</span><span class="badge badge-success side-badge">1</span></a>
					</li>
					<li class="side-item side-item-category">General</li>

                    <!-- Start with School Stages -->
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{route('stages.index') }}">
							<span class="side-menu__label">{{trans('stages_trans.title_page')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('stages.index') }}">{{trans('stages_trans.list_stages')}} </a></li>
						</ul>
					</li>
					<!-- Start with School classrooms -->
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{route('classrooms.index') }}">
							<span class="side-menu__label">{{trans('classrooms_trans.title_page')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('classrooms.index') }}">{{trans('classrooms_trans.list_classrooms')}} </a></li>
						</ul>
					</li>
					<!-- Start with School Sections -->
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{route('sections.index') }}">
							<span class="side-menu__label">{{trans('sections_trans.title_page')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('sections.index') }}">{{trans('sections_trans.list_sections')}} </a></li>
						</ul>
					</li>
					<!-- Start with my parents اولياءالامور -->
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#">
							<span class="side-menu__label">{{trans('parents_trans.title_page')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="#">{{trans('parents_trans.list_parents')}} </a></li>       
							<li><a class="slide-item" href="{{ url('add_parent')}}">{{trans('parents_trans.add_parent')}} </a></li>       
						</ul>
					</li>
					
				
					
					
					
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
