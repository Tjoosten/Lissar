@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance. --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Inschrijving toevoegen
                        
                        <a href="" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-undo"></i> Keer terug
                        </a>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('inschrijvingen.store') }}">
                            {{ csrf_field() }}

                            <fieldset>
                                <legend>Persoonsgevevens:</legend>

                                <div class="form-group @error('name', 'has-error')">
                                    <label class="control-label col-md-3">Naam: <span class="text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Naam van de persoon" @input('name')>
                                        @error('name')
                                    </div>
                                </div>

                                <div class="form-group @error('email_address', 'has-error')">
                                    <label class="control-label col-md-3">Email adres: <span class="text-danger">*</span></label>
                                    
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" placeholder="Email adres van de persoon" @input('email')>
                                        @error('email')
                                    </div>
                                </div>

                                <div class="form-group @error('tel_nummer', 'has-error')">
                                    <label class="control-label col-md-3">Tel. nummer: <span class="text-danger">*</span></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Telefoon nummer van de persoon" @input('tel_nummer')>
                                        @error('tel_nummer')
                                    </div>
                                </div>
                            </fieldset>

                            @if (count($products) > 0)
                                <fieldset>
                                    <legend>Bestelling:</legend>

                                    <div class="alert alert-warning alert-important alert-dismissable fade in" role="alert">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                        <strong><i class="fa fa-warning"></i> Info:</strong>
                                        Bij het aantal personen word een getal verwacht. bv "2" en niet "2 personen."
                                    </div>

                                    @php ($increment = 0)
                                    @foreach ($products as $product)
                                        <div class="form-group">
                                            <label class="control-label col-md-3">{{ $product->name }}:</label>

                                            <div class="col-md-2">
                                                <label class="control-label">{{ $product->price }}€ per persoon</label>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="hidden" name="order[{{ $increment }}][product] " value="{{ $product->id }}">
                                                <input type="text" class="form-control" name="order[{{ $increment }}][personen]" placeholder="Aantal Personen">
                                                @php ($increment++)
                                            </div>
                                        </div>
                                    @endforeach
                                </fieldset>
                            @endif
                        
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
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection