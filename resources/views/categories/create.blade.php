@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            @include('flash::message') {{-- Flash session view instance --}}

            <div class="row">
                @include('tickets.partials.navigation') {{-- Helpdesk navigation --}}

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection