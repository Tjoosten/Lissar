@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Gebruikersbeheer:

                        <div class="pull-right">
                            @if (count($users) > 15)
                                <button class="btn btn-xs btn-primary">
                                    <i class="fa fa-search"></i> Zoek gebruiker
                                </button>
                            @endif

                            <a href="" class="btn btn-xs btn-default">
                                <i class="fa fa-plus"></i> Nieuwe gebruiker.
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (count($users) > 0)
                            <div class="table-responsive">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status:</th>
                                            <th>Naam:</th>
                                            <th>Email:</th>
                                            <th colspan="2">Toegevoegd op:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td><strong>#{{ $user->id }}</strong></td>
                                                <td>
                                                    <span class="label label-success">
                                                        <i class="fa fa-check"></i> Actief
                                                    </span>
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                                <td>{{ $user->created_at->diffForHumans() }}</td>

                                                <td class="text-center">
                                                    <a href="{{ route('users.edit', $user) }}" class="text-danger">
                                                        <i class="fa fa-fw fa-pencil"></i>
                                                    </a>
                                                    <a href="" class="text-danger">
                                                        <i class="fa fa-ban"></i>
                                                    </a>
                                                    <a href="{{ route('users.delete', $user) }}" class="text-danger">
                                                        <i class="fa fa-fw fa-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{ $users->render() }}
                        @else
                            <div class="alert alert-info alert-important">
                                <strong><i class="fa fa-info-circle"></i> Info:</strong>
                                Er zijn geen gebruikers gevonden in het systeem.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection