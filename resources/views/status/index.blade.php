@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance. --}}

        <div class="row">
            @include('tickets.partials.navigation') {{-- The helpdesk navigation partial --}}
            
            <div class="col-md-12"> {{-- Content --}}
                <div class="panel panel-default"> {{-- Panel instance --}}
                    <div class="panel-heading"> {{-- Heading --}}
                        <i class="fa fa-fw fa-list"></i> Helpdesk status toevoegen.

                        <a href="{{ route('status.create') }}" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-plus"></i> Nieuwe status
                        </a>
                    </div> {{-- /Heading --}}

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ingevoegd door:</th>
                                        <th>Naam:</th>
                                        <th>Beschrijving:</th>
                                        <th colspan="2">Aangemaakt op:</th> {{-- Colspan="2" needed for the  functions --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($statusses) > 0) {{-- Statusses found in the system. --}}
                                        @foreach ($statusses as $status) {{-- Loop through the statusses --}}
                                            <tr>
                                                <td><strong>#{{ $status->id }}</strong></td>
                                                <td><span style="color: {{ $status->color_code }}">{{ $status->author->name }}</span></td>
                                                <td>{{ $status->description }}</td>
                                                
                                                <td> {{-- Options --}}
                                                    <a href="{{ route('status.edit', $status)" class="label label-warning"><i class="fa fa-wrench"></i> Wijzig</a>
                                                    <a href="{{ route('status.delete', $status) }}" class="label label-danger"><i class="fa fa-close"> Verwijder</a>
                                                </td> {{-- /Options --}}
                                            </td>
                                        @endforeach {{-- /END loop --}}
                                    @else {{-- No statusses found in the system --}}
                                        <tr><td colspan="6"><i>(Er zijn geen categorieen voor de helpdesk gevonden)</i></td></tr>
                                    @endif {{-- /END IF/ELSE--}}
                                </tbody>
                            </table>
                        </div>

                        {{ $statusses->render() }} {{-- Pagination view instance --}}
                    </div> {{--  /END Panel content --}}
                </div> {{-- /END Panel instance --}}
            </div> {{-- /END content --}}
        </div>
    </div>
@endsection