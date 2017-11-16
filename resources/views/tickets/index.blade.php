@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash message view instance --}}

        <div class="row">
            <div class="col-md-12"> {{-- Navigation bar --}}
                <div class="panel panel-default">
                    <div class="panel-body">

                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="#">Actieve ticketten <span class="badge">1</span></a></li>
                            <li role="presentation"><a href="#">Gesloten ticketten <span class="badge">95</span></a></li>
                            <li role="presentation"><a href="#">Dashboard</a></li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Configuratie <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="">Statussen</a></li>
                                    <li><a href="">Prioriteiten</a></li>
                                    <li><a href="">Vrijwilligers</a></li>
                                    <li><a href="">Categorieen</a></li>
                                    <li><a href="">Administrators</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div> {{-- /Navigation bar --}}

            {{-- Panels --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="fa fa-list"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1>96</h1>
                                    <div>Aantal ticketten</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="fa fa-wrench"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1>1</h1>
                                    <div>Open tickets</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="fa fa-thumbs-o-up"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1>95</h1>
                                    <span>Gesloten ticketten</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- /Panels --}}

            <div class="col-md-8"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Activiteits monitor:
                    </div>

                    <div class="panel-body">
                    </div>
                </div>
            </div> {{-- /Content --}}

            <div class="col-md-4"> {{-- Side navigation --}}

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                            <i class="fa fa-users"></i> Gebruikers
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
                            <i class="fa fa-users"></i> Admins
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                            <i class="fa fa-tags"></i> Categorieen
                        </a>
                    </li>
                </ul>

            </div> {{-- /Side navigation --}}
        </div>
    </div>
@endsection