@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-3"> {{-- Side navigation --}}
                <div class="list-group">
                    <a role="presentation" href="#unread" aria-controls="unread" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-bell-o"></i> Ongelezen notificaties
                    </a>

                    <a role="presentation" href="#all" aria-controls="all" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-bell-o"></i> Alle notificaties
                    </a>
                </div>
            </div> {{-- /END side navigation --}}

            <div class="col-md-9"> {{-- Content --}}
                <div class="tab-content"> {{-- Tab content --}}
                    <div role="tabpanel" class="tab-pane fade in active" id="unread"> {{-- Unread notification tab pane --}}
                        <div class="panel panel-default">
                            <div class="panel-heading"> {{-- Content header --}}
                                <i class="fa fa-fw fa-bell-o"></i> Ongelezen notificaties

                                <a href="{{ route('notifications.read.all') }}" class="pull-right btn btn-xs btn-primary">
                                    <i class="fa fa-check"></i> Markeer alles als gelezen
                                </a>
                            </div> {{-- /END content header --}}

                            <div class="panel-body"> {{-- Content-body --}}
                                <div class="notifications-container">
                                    <div class="header">
                                        <h4>Notifications</h4>
                                    </div>

                                    <ul>
                                        @if (count($unreadNotifications) == 0) {{-- User has no unread notifications --}}
                                            <li class="notification info">
                                                <div class="icon">
                                                    <span class="fa fa-square-o" aria-hidden="true"></span>
                                                </div>

                                                <div class="content">
                                                    <div>Er zijn geen nieuwe notificaties gevonden!</div>
                                                    <small>- een paar seconden geleden</small>
                                                </div>
                                            </li>
                                        @else {{-- There are new notifications. --}}
                                            @foreach ($unreadNotifications as $unreadNotification)
                                                <li location.href='http://example'; class="notification danger">
                                                    <div class="icon">
                                                        <i class="fa fa-close"></i>
                                                    </div>

                                                    <div class="profile-image">
                                                        <img src="http://via.placeholder.com/45x45">
                                                    </div>

                                                    <div class="content">
                                                        <div>New notification</div>
                                                        <small>00/00/00</small>
                                                    </div>

                                                    <div class="icon-group">
                                                        <a href=""><i class="fa fa-check"></i></a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>

                                    {{ $unreadNotifications->render() }} {{-- Pagination view instance --}}
                                </div>
                            </div> {{-- /END content body --}}
                        </div>
                    </div> {{-- /Unread notification tab pane --}}

                    <div role="tabpanel" class="tab-pane fade in" id="all"> {{-- All notifications tab pane --}}
                        <div class="panel panel-default">
                            <div class="panel-heading"> {{-- Content header --}}
                                <i class="fa fa-fw fa-bell-o"></i> Alle notificaties
                            </div> {{-- /END content header --}}

                            <div class="panel-body"> {{-- Content body --}}
                                <div class="notifications-container">
                                    <div class="header">
                                        <h4>Notifications</h4>
                                    </div>

                                    <ul>
                                        @if (count($readNotifications)) == 0) {{-- User has no unread notifications --}}
                                            <li class="notification info">
                                                <div class="icon">
                                                    <span class="fa fa-square-o" aria-hidden="true"></span>
                                                </div>

                                                <div class="content">
                                                    <div>Er zijn geen notificaties gevonden voor uw account!</div>
                                                    <small>- een paar seconden geleden</small>
                                                </div>
                                            </li>
                                        @else {{-- There are new notifications. --}}
                                            @foreach ($readNotifications as $readNotification)
                                                <li location.href='http://example'; class="notification {{ $readNotification->type }}">
                                                    <div class="icon">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </div>

                                                    <div class="profile-image">
                                                        <img src="http://via.placeholder.com/45x45">
                                                    </div>

                                                    <div class="content">
                                                        <div>New notification</div>
                                                        <small>00/00/00</small>
                                                    </div>

                                                    <div class="icon-group">
                                                        <a href=""><i class="fa fa-check"></i></a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>

                                    {{ $readNotifications->render() }} {{-- Pagination view instance --}}
                                </div>
                            </div> {{-- /END Content body --}}
                        </div>
                    </div> {{-- /All notifications tab pane --}}
                </div> {{-- /END tab content --}}
            </div> {{-- /Content --}}
        </div>
    </div>
@endsection