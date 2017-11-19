@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-cogs fa-fw"></i> Instellingen:
                    </div>

                    <div class="list-group">
                        <a href="#info" aria-controls="info" role="tab" data-toggle="tab" class="list-group-item">
                            <i class="fa fa-fw fa-info-circle"></i> Account informatie
                        </a>

                        <a href="#security" aria-controls="security" role="tab" data-toggle="tab" class="list-group-item">
                            <i class="fa fa-fw fa-key"></i> Account beveiliging
                        </a>

                        <a href="#apikeys" aria-controls="apikeys" role="tab" data-toggle="tab" class="list-group-item">
                            <i class="fa fa-fw fa-code"></i> API Sleutels
                        </a>
                    </div>
                </div>
            </div> {{-- /Sidebar --}}

            <div class="col-md-9"> {{-- Panel content --}}
                <div class="tab-content"> {{-- Panels --}}
                    <div role="tabpanel" class="tab-pane @if (Request::segment(2) === 'info') active @endif }}" id="info"> @include('account-settings.information') </div>
                    <div role="tabpanel" class="tab-pane @if (Request::segment(2) === 'security') active @endif }}" id="security">    @include('account-settings.security')    </div>
                    <div role="tabpanel" class="tab-pane @if (Request::segment(2) === 'apikeys') active @endif }}" id="apikeys">     @include('account-settings.api-keys')    </div>
                </div> {{-- /End panels --}}
            </div> {{-- END panel contentr --}}
        </div>
    </div>
@endsection