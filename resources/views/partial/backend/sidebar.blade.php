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

    @role(['admin'])
{{-- $admin_side_menu = Permission::tree()--}}
@foreach($admin_side_menu as $menu)
    {{--This mean that there is no Childrens--}}
    @if($menu->appeardChildren()->count() == 0)
        <!-- Nav Item - Dashboard -->
            <li class="nav-item {{$menu->id == getParentShowOf($current_page) ? 'active' : null}}">
                <a class="nav-link"
                   href="{{route('admin.'.$menu->as)}}">
                    <i class="{{$menu->icon ?? 'fas fa-home'}}"></i>
                    <span>{{$menu->display_name}}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
    @else
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'active' : null}}">
            <a class="nav-link {{in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? null : 'collapsed'}}"
               href="#"
               data-toggle="collapse"
               data-bs-toggle="collapse"
               data-bs-target="#collapse_{{$menu->route}}"
               aria-expanded="{{$menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != '' ? 'fasle' : 'true'}}"
               aria-controls="collapse_{{$menu->route}}">
                <i class="{{$menu->icon ?? 'fas fa-home'}}"></i>
                <span>{{$menu->display_name}}</span>
            </a>

            @if(isset($menu->appeardChildren) && count($menu->appeardChildren) > 0)
                <div id="collapse_{{$menu->route}}"
                     class="collapse {{in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'show' : null}}"
                     aria-labelledby="heading_{{$menu->route}}"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @foreach($menu->appeardChildren as $sub_menu)
                            <a class="collapse-item {{getParentOf($current_page) != null ?? (int)(getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : null}}"
                               href="{{route('admin.'.$sub_menu->as)}}">
                                {{$sub_menu->display_name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </li>
    @endif
@endforeach
@endrole

    @role(['supervisor'])
    {{-- $admin_side_menu = Permission::tree()--}}
    @foreach($admin_side_menu as $menu)
        @permission($menu->name)
        {{--This mean that there is no Childrens--}}
        @if($menu->appeardChildren()->count() == 0)
        <!-- Nav Item - Dashboard -->
            <li class="nav-item {{$menu->id == getParentShowOf($current_page) ? 'active' : null}}">
                <a class="nav-link"
                   href="{{route('admin.'.$menu->as)}}">
                    <i class="{{$menu->icon ?? 'fas fa-home'}}"></i>
                    <span>{{$menu->display_name}}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        @else
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'active' : null}}">
                <a class="nav-link {{in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? null : 'collapsed'}}"
                   href="#"
                   data-toggle="collapse"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapse_{{$menu->route}}"
                   aria-expanded="{{$menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != '' ? 'fasle' : 'true'}}"
                   aria-controls="collapse_{{$menu->route}}">
                    <i class="{{$menu->icon ?? 'fas fa-home'}}"></i>
                    <span>{{$menu->display_name}}</span>
                </a>

                @if(isset($menu->appeardChildren) && count($menu->appeardChildren) > 0 !== null)
                    <div id="collapse_{{$menu->route}}"
                         class="collapse {{in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'show' : null}}"
                         aria-labelledby="heading_{{$menu->route}}"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @foreach($menu->appeardChildren as $sub_menu)
                                @permission($sub_menu->name)
                                <a class="collapse-item {{getParentOf($current_page) != null ?? (int)(getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : null}}"
                                   href="{{route('admin.'.$sub_menu->as)}}">
                                    {{$sub_menu->display_name}}
                                </a>
                                @endpermission
                            @endforeach
                        </div>
                    </div>
                @endif
            </li>
        @endif
        @endpermission
    @endforeach
    @endrole

</ul>
<!-- End of Sidebar -->
