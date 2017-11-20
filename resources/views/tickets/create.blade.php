@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            @include('tickets.partials.navigation') {{-- Helpdesk tickets navigation --}}
            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bug"></i> Meld een probleem of vraag ondersteuning:
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('ticket.store') }}">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group @error('subject', 'has-error')"> {{-- Subject --}}
                                <label class="control-label col-md-3">Title: <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="De titel van je bug of vraag" @input('subject')>
                                    @error('subject')
                                </div>
                            </div>

                            <div class="form-group @error('category_id', 'has-error')"> {{-- Category --}}
                                <label class="control-label col-md-3">Categorie: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <select @input('category_id') class="form-control">
                                        <option value="">-- Selecteer de categorie --</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') {{-- Error instance --}}
                                </div>
                            </div>

                            @hasanyrole('admin|verantwoordelijke')
                                @role('admin') {{-- Can only be accessed by admins --}}
                                    <div class="form-group @error('assignee_id', 'has-error')">
                                        <label class="control-label col-md-3">Toewijzen aan:</label>

                                        <div class="col-md-9">
                                            <select class="form-control" @input('assignee_id')>
                                                <option value="">-- Selecteer de gebruiker --</option>

                                                @foreach ($users as $user) {{-- Loop through the users --}}
                                                    <option value="{{ $user->id }}">{{ $user->name }} </option> 
                                                @endforeach {{-- /END loop --}} 
                                            </select>

                                            @error('assignee_id') {{-- Display the  assignee error --}}
                                        </div>
                                    </div>

                                    <div class="form-group @error('priority_id', 'has-error')">
                                        <label class="control-label col-md-3">Prioriteit:</label>

                                        <div class="col-md-9">
                                            <select class="form-control" @input('priority_id')>
                                                <option value="">-- Selecteer de prioriteit --</option>

                                                @foreach ($priorities as $priority) {{-- Loop through the priorities --}}
                                                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endforeach {{-- /END priorities --}}
                                            </select>
                                            @error('priority_id') {{-- Display the priority errors --}}
                                        </div>
                                    </div>
                                @endrole

                                @role('verantwoordelijke') {{-- Can only be accessed by verantwoordelijken --}}
                                    <div class="form-group @error('priority_id', 'has-error')">
                                        <label class="control-label col-md-3">Prioriteit:</label>

                                        <div class="col-md-9">
                                            <select class="form-control" @input('priority_id')>
                                                <option value="">-- Selecteer de prioriteit --</option>

                                                @foreach ($priorities as $priority) {{-- Loop through the priorities --}}
                                                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endforeach {{-- /END priorities --}}
                                            </select>
                                            @error('priority_id') {{-- Display the priority errors --}}
                                        </div>
                                    </div>
                                @endrole
                            @endhasanyrole

                            <div class="form-group @error('description', 'has-error')"> {{-- Description --}}
                                <label class="control-label col-md-3">Beschrijving: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <textarea type="text" @input('description') class="form-control" placeholder="Beschrijf je bug of vraag." rows="7">@text('description')</textarea>
                                    @if ($errors->has('description'))
                                        @error('description')
                                    @else
                                        <span class="small help-block">* Dit veld is markdown ondersteund.</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group"> {{-- Submit and reset --}}
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> Opslaan
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