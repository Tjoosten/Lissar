@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            @include('tickets.partials.navigation') {{-- Helpdesk navigation bar --}}

            <div class="col-md-12">
                <div class="panel panel-default"> {{-- Content --}}
                    <div class="panel-heading"> {{-- Heading --}}
                        <i class="fa fa-fw fa-plus"></i> Helpdesk prioriteiten

                        <a href="{{ route('priorities.create') }}" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-plus"></i> Prioriteit toevoegen
                        </a>
                    </div> {{-- /Heading --}}

                    <div class="panel-body"> {{-- Panel-content --}}
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ingevoegd door:</th>
                                        <th>Naam:</th>
                                        <th>Beschrijving:</th>
                                        <th colspan="2">Aangemaakt op:</th> {{-- Colspan 2 is nodig voor de functies --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($priorities) > 0) {{-- Priorities are found --}}
                                        @foreach ($priorities as $priority) {{-- Loop through priorities --}}
                                            <tr>
                                                <td><strong>#{{ $priority->id }}</strong></td>
                                                <td>{{ $priority->author->name }}</td>
                                                <td><span style="color: {{ $priority->color_code }}">{{ $priority->name }}</span></td>
                                                <td>{{ $priority->description }}</td>
                                                <td>{{ $priority->created_at->diffForHumans() }}</td>

                                                <td> {{-- Options --}}
                                                    <a href="{{ route('priorities.edit', $priority) }}" class="label label-warning"><i class="fa fa-wrench"></i> Wijzig</a>
                                                    <a href="{{ route('priorities.destroy', $priority) }}" class="label label-danger"><i class="fa fa-close"></i> Verwijder</a>
                                                </td> {{-- /Options --}}
                                            </td>
                                        @endforeach {{-- END loop --}}
                                    @else {{-- No priorities found --}}
                                        <tr>
                                            <td colspan="6"><i>(Er zijn geen helpdesk prioritieiten gevonden)</i></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{ $priorities->render() }} {{-- Pagination instance --}}
                    </div> {{-- /Panel content --}}
                </div> {{-- /Content --}}
            </div>
        </div>
    </div>
@endsection