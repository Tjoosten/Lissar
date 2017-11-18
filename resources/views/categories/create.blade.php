@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            @include('flash::message') {{-- Flash session view instance --}}

            <div class="row">
                @include('tickets.partials.navigation') {{-- Helpdesk navigation --}}

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> {{-- Heading --}}
                            <i class="fa fa-fw fa-plus"></i> Categorie toevoegen 

                            <a href="{{ route('categories.index') }}" class="pull-right btn btn-xs btn-default">
                                <i class="fa fa-undo"></i> Keer terug
                            </a>
                        </div> {{-- END heading --}}

                        <div class="panel-body"> {{-- Body --}}
                            <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}"> 
                                {{ csrf_field() }} {{-- CSRF form field protection --}}

                                <div class="form-group @error('name', 'has-error')">
                                    <label class="control-label col-md-3">Categorie naam: <span class="text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Naam van de helpdesk categorie" @input('name')>
                                        @error('name')
                                    </div>
                                </div>

                                <div class="form-group @error('color_code', 'has-error')">
                                    <label class="control-label col-md-3">Categorie kleur code: <span class="text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <input type="color" class="form-control" @input('color_code')>
                                        @error('color_code')
                                    </div>
                                </div>

                                <div class="form-group @error('description', 'has-error')">
                                    <label class="control-label col-md-3">Categorie beschrijving: <span class="text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="7" placeholder="Beschrijving van de categorie" @input('description')>@text('description')</textarea>
                                        @if ($errors->has('description'))   {{-- Errors found --}} 
                                            @error('description')           {{-- Display the error --}}
                                        @else                               {{-- No errors found --}}
                                            <span class="small help-block"><span class="text-danger">*</span> Dit veld is markdown ondersteund</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-check"></i> Opslaan
                                        </button>

                                        <button type="reset" class="btn btn-sm btn-link">
                                            <i class="fa fa-undo"></i> Annuleren
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> {{-- END Body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection