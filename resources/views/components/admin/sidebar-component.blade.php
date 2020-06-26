@php
    $segGroup = request()->segment(2);
    $segMenu = request()->segment(3);
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $user->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @foreach($sidebar as $g)
{{--                    @if($g['group']['segment_name'] == $segGroup)--}}
{{--                        @php($statGroup = 'menu-open')--}}
{{--                    @else--}}
{{--                        @php($statGroup = '')--}}
{{--                    @endif--}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link {{ $statGroup ?? '' }}">
                            <i class="nav-icon {{ $g['group']['icon'] }}"></i>
                            <p>
                                {{ $g['group']['name'] }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach($g['menu'] as $m)
{{--                                @if($m['segment_name'] == $segMenu)--}}
{{--                                    @php($statMenu = 'active')--}}
{{--                                @else--}}
{{--                                    @php($statMenu = '')--}}
{{--                                @endif--}}
                            <li class="nav-item">
                                <a href="{{ route($m['route']) }}" class="nav-link {{ $statMenu ?? '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $m['name'] }}</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
