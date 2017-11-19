<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> {{-- TODO: Register this one to the app.scss --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    {{-- Collapsed Hamburger --}}
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}"> {{-- Branding Image --}}
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    {{-- Left Side Of Navbar --}}
                    <ul class="nav navbar-nav">
                        <li class="dropdown @if(Request::is('users*') || Request::is('apikeys*') || Request::is('acl*')) active @endif">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <i class="fa fa-users"></i> Gebruikers <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Logins</li>
                                <li><a href="{{ route('users.index') }}"><i class="fa fa-fw fa-users"></i> Vrijwilligers</a></li>
                                <li><a href="{{ route('users.index') }}"><i class="fa fa-fw fa-users"></i> Bezoekers</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Overige</li>
                                <li>
                                    <a href="{{ route('acl.index') }}">
                                        <i class="fa fa-fw fa-key"></i> Permissies
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('apikeys.index') }}">
                                        <i class="fa fa-fw fa-code"></i> API Sleutels
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="@if (Request::is('subscriptions*') || Request::is('products*')) active @endif dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <i class="fa fa-file-text"></i> Inschrijvingen <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('inschrijvingen.index') }}"><i class="fa fa-fw fa-users"></i> Ingeschreven personen</a></li>
                                <li><a href="{{ route('producten.index') }}"><i class="fa fa-fw fa-asterisk"></i> Producten</a></li>
                            </ul>
                        </li>
                        <li @if(Request::is('tickets*')) class="active" @endif>
                            <a href="{{ route('tickets.index') }}">
                                <i class="fa fa-list"></i> Helpdesk
                            </a>
                        </li>
                        <li @if(Request::is('Logs*')) class="active" @endif>
                            <a href="{{ route('logs.index') }}">
                                <i class="fa fa-file-text"></i> Logs
                            </a>
                        </li>
                    </ul>

                    {{-- Right Side Of Navbar --}}
                    <ul class="nav navbar-nav navbar-right">
                        {{-- Authentication Links --}}
                        @guest
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Aanmelden
                                </a>
                            </li>
                        @else
                            <li @if (Request::is('notifications*')) class="active" @endif>
                                <a href="{{ route('notifications.index') }}">
                                    <i class="fa fa-bell-o"></i>

                                    @if ($user->unreadNotifications()->count() > 0) {{-- The user has unread notifications --}}
                                        <span class="badge">{{ $user->unreadNotifications->count() }}</span>
                                    @endif 
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ $user->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('account.settings', ['type' => 'info']) }}">
                                            <i class="fa fa-fw fa-cogs"></i> Instellingen.
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ticket.create') }}">
                                            <i class="fa fa-fw fa-bug"></i> Meld een probleem.
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-sign-out"></i> Afmelden
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
