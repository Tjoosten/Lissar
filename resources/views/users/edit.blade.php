@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance.§ --}}

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> Wijzig account: <strong>{{ $user->name }}</strong>

                        <a href="{{ route('users.index') }}" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-undo"></i> Ga terug.
                        </a>
                    </div>

                    <div class="panel-body">
                        <form action="" method="POST" class="form-horizontal">
                            {{ csrf_field() }}  {{-- CSRF form field protection --}}

                            <div class="form-group @error('name', 'has-error')">
                                <label class="control-label col-md-3">Naam: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="naam van de gebruiker" @input('name', $user->name)>
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group @error('email', 'has-error')">
                                <label class="control-label col-md-3">E-mail adres: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Gebruiker zijn email adres" @input('email', $user->email)>
                                    @error('email')
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Gebruikers niveau: <span class="text-danger">*</label>

                                <div class="col-md-9 @error('roles', 'has-error')">
                                    <select class="form-control" @input('roles')>
                                        <option value="">-- Selecteer het permissie niveau van de gebruiker --</option>
                                        @options($roles, 'roles', auth()->user()->pluck('id', 'name')->toArray())
                                    </select>
                                    @error('roles') {{-- Instance for the roles validation errors. --}}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-10">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> Opslaan.
                                    </button>

                                    <button type="reset" class="btn btn-link btn-sm">
                                        <i class="fa fa-undo"></i> Annuleren
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection