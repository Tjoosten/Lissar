@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            @include('tickets.partials.navigation') {{-- Helpdesk navigation --}}

            <div class="col-md-12"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading"> {{-- Panel heading --}}
                        <i class="fa fa-fw fa-tags"></i> Helpdesk categorieen.

                        <a href="{{ route('categories.create') }}" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-plus"></i> Categorie toevoegen
                        </a>
                    </div> {{-- END panel heading --}}

                    <div class="panel-body"> {{-- Panel content --}}
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
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
                                    @if (count($categories) > 0) {{-- Categorieen gevonden --}} 
                                        @foreach ($categories as $category) {{-- Loop through the categories --}}
                                            <tr>
                                                <td><strong>#{{ $category->id }}</strong></td>
                                                <td>{{ $category->author->name }}</td>
                                                <td><span style="color: {{ $category->color_code }}">{{ $category->name }}</span></td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ $category->created_at->diffForHumans() }}</td>

                                                <td class="text-center"> {{-- Options --}}
                                                </td> {{-- END Options --}}
                                            <tr>
                                        @endforeach {{-- END LOOP --}} 
                                    @else {{-- Geen categorieen gevonden --}}
                                        <tr>
                                            <td colspan="6"><i>(Er zijn geen categorieen voor de helpdesk gevonden)</i></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{ $categories->render() }} {{-- Pagination view instance --}}
                    </div> {{-- END panel content --}}
                </div>
            </div> {{-- END content --}}
        </div>
    </div>
@endsection