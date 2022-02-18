<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a class="c-header-brand d-sm-none" href="{{route("backend.dashboard")}}"><img class="c-header-brand" src="{{asset("img/backend-logo.jpg")}}" style="max-height:50px;min-height:40px;" alt="{{ app_name() }}"></a>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>

    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3">
            <a class="c-header-nav-link" href="{{ route('frontend.index') }}" target="_blank">
                <i class="c-icon cil-external-link"></i>&nbsp;
                {{ app_name() }}
            </a>
        </li>
    </ul>

    <ul class="c-header-nav ml-auto mr-4">

        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>@lang('Account')</strong></div>

                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="c-icon cil-user"></i>&nbsp;
                    {{ Auth::user()->name }}
                </a>
                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="c-icon cil-at"></i>&nbsp;
                    {{ Auth::user()->email }}
                </a>
                <div class="dropdown-header bg-light py-2"><strong>@lang('Settings')</strong></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="c-icon cil-account-logout"></i>&nbsp;
                    @lang('Logout')
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
            </div>
        </li>
    </ul>
    <div class="c-subheader justify-content-between px-3">
        <ol class="breadcrumb border-0 m-0">
            @yield('breadcrumbs')
        </ol>

    </div>
</header>