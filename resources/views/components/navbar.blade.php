@if(isset($navbar_for_landing))
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
@else
<nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top">
@endisset
    <div class="container">
        <a class="navbar-brand" href="{{ route('landingPage') }}" style="color:#0E8C7F; font-size:2em;">
            <b>Spons</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('eventsPage') }}" style="color:#0E8C7F;font-size:1.3em;"><b>Events</b></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('companiesPage') }}" style="color:#0E8C7F;font-size:1.3em;"><b>Companies</b></a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="btn green-btn" style="margin: 4px 0px 4px 10px" role="button" href="{{ route('loginPage') }}">{{ __('Login') }}</a>
                    </li> &nbsp; &nbsp;
                    <li class="nav-item" >
                        <a class="btn purple-invert-btn" style="margin: 4px 4px" role="button" href="{{ route('registerStudentPage') }}" >{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" style="color:#0E8C7F;font-size:1.3em;" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role === Constant::ROLE_STUDENT_INDIVIDUAL || Auth::user()->role === Constant::ROLE_STUDENT_ORGANIZATION)
                                <a class="dropdown-item" href="{{ route('createEventPage') }}">{{ __('Create Event') }}</a>
                            @endif

                            @if(Auth::user()->role === Constant::ROLE_COMPANY)
                                <a class="dropdown-item" href="{{ route('createGrant') }}">{{ __('Create Grant') }}</a>
                            @endif

                            <a class="dropdown-item" href="{{ route('profilePage') }}">{{ __('Profile') }}</a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
