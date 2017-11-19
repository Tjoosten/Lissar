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
                        <form class="form-horizontal" method="POST" action="">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group"> {{-- Subject --}}
                                <label class="control-label col-md-3">Title: <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="De titel van je bug of vraag">
                                </div>
                            </div>

                            <div class="form-group"> {{-- Category --}}
                                <label class="control-label col-md-3">Categorie: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <select class="form-control">
                                        <option value="">-- Selecteer de categorie --</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"> {{-- Description --}}
                                <label class="control-label col-md-3">Beschrijving: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <textarea class="form-control" placeholder="Beschrijf je bug of vraag." rows="7"></textarea>
                                    <small class="help-block">* Dit veld is markdown ondersteund.</small>
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