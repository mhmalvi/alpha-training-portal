<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <div class="d-flex justify-content-center">
                        <img alt="image" class="rounded-circle" src="{{asset((Auth::user()->profile_photo_path)? 'storage/users/'.Auth::user()->profile_photo_path : 'assets/profile.png')}}" style="max-width: 48px;"/>
                    </div>
                </div>
                <div class="logo-element">
                    ATR
                </div>
            </li>

            {{-- Navigations Starts --}}

            <li>
                <a href="{{route('home')}}"><i class="fa fa-globe"></i> <span class="nav-label">Visit Site</span></a>
            </li>
            <li class="{{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
                <a href="{{route('admin.home')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li class="{{ (request()->segment(1) == 'attributes') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-cubes"></i> <span class="nav-label">Attributes</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Route::currentRouteName() == 'admin.category') ? 'active' : '' }}"><a href="{{route('admin.category')}}">Categories</a></li>
                </ul>
            </li>
            <li class="{{ (request()->segment(1) == 'blog') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Blogs</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Route::currentRouteName() == 'admin.blog.create') ? 'active' : '' }}"><a href="{{route('admin.blog.create')}}">Post New Blog</a></li>
                    <li class="{{ (Route::currentRouteName() == 'admin.blog.index') ? 'active' : '' }}"><a href="{{route('admin.blog.index')}}">Manage Blogs</a></li>
                </ul>
            </li>
            <li class="{{ (request()->segment(1) == 'settings') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Route::currentRouteName() == 'admin.userProfile') ? 'active' : '' }}"><a href="{{route('admin.userProfile')}}">Profile</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>