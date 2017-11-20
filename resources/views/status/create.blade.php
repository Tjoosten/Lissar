@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            @include('tickets.partials.navigation') {{-- Helpdesk navigation partial --}}

            <div class="col-md-12"> {{-- COL --}}
                <div class="panel panel-default"> {{-- Content panel --}}
                    <div class="panel-heading"> {{-- Heading --}}
                        <i class="fa fa-fw fa-plus"></i> Helpdesk status toevoegen. 

                        <a href="{{ route('status.index') }}" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-undo"></i> Keer terug 
                        </a>
                    </div> {{-- /END heading --}}

                    <div class="panel-body"> {{-- Panel content --}}
                        <form class="form-horizontal" method="POST" action="{{ route('status.store') }}"> {{-- Create form --}}
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group @error('name', 'has-error')">
                                <label class="col-md-3 control-label">Status naam: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Naam van je status label" @input('name')>
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group @error('name', 'has-error')">
                                <label class="col-md-3 control-label">Status kleur code: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="color" class="form-control" @input('color_code')>
                                    @error('color_code')
                                </div>
                            </div>

                            <div class="form-group @error('description')">
                                <label class="col-md-3 control-label">Status beschrijving: <span class="text-danger"></span></label>

                                <div class="col-md-9">
                                    <textarea type="text" class="form-control" placeholder="Beschrijving van je status label" rows="7" @input('description')>@text('description')</textarea>
                                    @if ($errors->has('description')) {{-- Field has errors --}}
                                        @error('description')
                                    @else {{-- No errors found. --}}
                                        <span class="small help-block"><span class="text-danger">*</span> Dit veld is markdown ondersteund. </span>
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
                        </form> {{-- /End create form --}}
                    </div> {{-- /Panel content --}}
                </div> {{-- /Content panel --}}
            </div> {{-- /END col --}}
        </div>
    </div>
@endsection