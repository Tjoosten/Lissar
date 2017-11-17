@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Platform activiteit
                    </div>

                    <div class="panel-body">
                        @if (count($activities) > 0) {{-- There are activity logs found. --}}
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Uitgevoerd door:</th>
                                            <th>Beschrijving:</th>
                                            <th>Uitgevoerd op:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activities as $activity) {{-- Loop through activity data --}}
                                            {{-- TODO: Create table contents --}}
                                        @endforeach {{-- /End activity data --}}
                                    </tbody>
                                </table>
                            </div>

                            {{ $activities->render() }} {{-- Pagination view instance form the vendor DIR --}}
                        @else {{-- No platform activity --}}
                            <div class="alert alert-info alert-important" role="alert">
                                <strong><i class="fa fa-info-circle"></i></strong> Info:
                                Er is nog geen platform activiteit waargenomen.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection