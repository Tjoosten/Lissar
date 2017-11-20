@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance. --}}

        <div class="container">
            <div class="row">
                @include('tickets.partials.navigation') {{-- Tickets helpdesk navigation --}}

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> {{-- Heading --}}
                            <i class="fa fa-plus"></i> Helpdesk prioriteit toevoegen 

                            <a href="" class="pull-right btn btn-xs btn-default">
                                <i class="fa fa-undo"></i> Keer terug
                            </a> 
                        </div> {{-- /Heading --}}

                        <div class="panel-body"> {{-- Content --}}
                            <form class="form-horizontal" method="POST" action="{{ route('priorities.store') }}">
                                {{ csrf_field() }} {{-- Form field protection --}}

                                <div class="form-group @error('name', 'has-error')">
                                    <label class="control-label col-md-3">Prioriteits naam: <span class="text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Naam v/d prioriteit" @input('name')>
                                        @error('name')
                                    </div>
                                </div>

                                <div class="form-group @error('name', 'color_code')">
                                    <label class="control-label col-md-3">Prioriteit kleur code: <span class="text-danger">*</span></label>
                                
                                    <div class="col-md-9">
                                        <input type="color" class="form-control" @input('color_code')>
                                        @error('color_code')
                                    </div>
                                </div>

                                <div class="form-group @error('description', 'has-error')">
                                    <label class="control-label col-md-3">Prioriteit beschrijving: <span class="text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="7" placeholder="Beschrijving van de prioriteit" @input('description')>@text('description')</textarea>
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
                                            <i class="fa fa-unfo"></i> Annuleren 
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> {{-- /Content --}}
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection