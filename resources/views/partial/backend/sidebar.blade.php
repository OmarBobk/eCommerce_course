@php
    $current_page = \Route::currentRouteName(); // ex: admin.index
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{route('admin.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{config('app.name')}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @foreach($admin_side_menu as $menu)

        {{--This mean that there is no Childrens--}}
        @if($menu->appeardChildren()->count() == 0)
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link"
                   href="{{route('admin.'.$menu->as)}}">
                    <i class="{{$menu->icon ?? 'fas fa-home'}}"></i>
                    <span>{{$menu->display_name}}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        @endif

    @endforeach




    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">

        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown link
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>

    </li>


</ul>
<!-- End of Sidebar -->
