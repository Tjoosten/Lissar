@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Session Flash message instance. --}}

        <div class="row">
            <div class="col-md-12"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading"> {{-- Heading --}}
                        <i class="fa fa-fw fa-list"></i> Inschrijvingen mosselsouper 

                        <div class="pull-right">
                            <a href="" class="btn btn-xs btn-default"><i class="fa fa-search"></i> Zoek</a>
                            <a href="{{ route('inschrijvingen.create') }}" class="btn btn-xs btn-default"><i class="fa fa-user-plus"></i> Inschrijving toevoegen</a>
                            <a href="" class="btn btn-xs btn-default"><i class="fa fa-download"></i> Exporteer</a>
                        </diV>
                    </div> {{-- /Heading --}}

                    <div class="panel-body"> {{-- Content --}}
                        <div class="table-responsive"> {{-- Table --}}
                            <table class="table table-responsive table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Naam:</th>
                                        <th>Tel. Nr</th>
                                        <th>Aantal personen:</th>
                                        <th colspan="2">Toegevoegd op.:</th> {{-- Colspan="2" Nodig foor de functies --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($subscriptions) > 0) {{-- There are subscriptions found. --}}
                                        @foreach ($subscriptions as $subscription) {{-- LOOP through the subscriptions --}}
                                            <tr>
                                                <td><code>#{{ $subscription->id }}</code></td>
                                                <td><a href="mailto:{{ $subscription->email_address }}">{{ $subscription->name }}</a></td>
                                                <td>{{ $subscription->tel_nr }}</td>
                                                <td>{{ $subscription->persons_amuunt }}</td>
                                                <td>{{ $subscription->created_at->diffForHumans() }}</td>

                                                <td class="text-center"> {{-- /End options --}}
                                                    <a href="{{ route('inschrijvingen.info', $subscription) }}" class="label label-info"><i class="btn btn-info-circle"></i> Info</a>
                                                    <a href="{{ route('inschrijvingen.delete', $subscription) }}" class="label label-danger"><i class="btn btn-close"></i> Verwijder</a>
                                                </td> {{-- /END options --}}
                                            </tr>
                                        @endforeach {{-- /END Loop --}}
                                    @else {{-- No Subscriptions found. --}}
                                        <tr><td colspan="7"><i>(Er zijn geen inschrijvingen gevonden in het systeem.)</i></td></tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div> {{-- /END table --}}
                    </div> {{-- /END Content --}}
 
                    {{ $subscriptions->render() }} {{-- Pagination view instance --}}
                </div>
            </div> {{-- /END Content --}}
        </div>
    </div>
@endsection