@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-offset-2 col-md-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> Wijzig account: <strong>{{ $user->name }}</strong>

                        <a href="{{ route('users.index') }}" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-undo"></i> Ga terug.
                        </a>
                    </div>

                    <div class="panel-body">
                        <form action="" method="POST" class="form-horizontal">
                            {{ csrf_field() }} {{-- CSRF form field protection --}}

                            <div class="form-group">
                                <label class="control-label col-md-3">Voornaam: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Achternaam: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">E-mail adres: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
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