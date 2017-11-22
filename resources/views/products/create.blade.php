@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance. --}}

        <div class="row">
            @include('products.partials.navigation') {{-- Product navigation partial. --}}
        
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Product toevoegen.
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('producten.store') }}">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group col-md-6 @error('name', 'has-error')">
                                <label>Naam product: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Naam van het product" @input('name')>
                                @error('name')
                            </div>

                            <div class="form-group col-md-3 @error('price', 'has-error')">
                                <label>Prijs van het product <span class="text-danger">*</label>
                                <input type="text" class="form-control" placeholder="Prijs van het product" @input('price')>
                                @error('price')
                            </div>

                            <div class="form-group col-md-9 @error('type', 'has-error')">
                                <label>Product category: <span class="text-danger">*</span></label>

                                <select @input('type') class="form-control">
                                    <option value="">-- Selecteer de categorie van het product --</option>
                                    <option value="Eten"       @if (old('Eten') == 'Eten')       selected @endif>Eten</option>
                                    <option value="Drank"      @if (old('type') == 'Drank')      selected @endif>Drank</option>
                                    <option value="Drankkaart" @if (old('type') == 'Drankkaart') selected @endif>Drankkaart</option>
                                </select>

                                @error('type')
                            </div>

                            <div class="form-group col-md-12 @error('description', 'has-error')">
                                <label>Product beschrijving: <span class="text-danger">*</span></label>
                                <textarea rows="7" placeholder="Beschrijving van het product" class="form-control" type="text" @input('description')>@text('description')</textarea>

                                @if ($errors->has('description')) {{-- There are arrors found --}}
                                    @error('description') {{-- Error instance --}}
                                @else {{-- No errors found --}}
                                    <span class="small help-block"><span class="text-danger">*</span> Dit veld is markdown ondersteund.</span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Opslaan
                                </button>

                                <button type="submit" class="btn btn-sm btn-link">
                                    <i class="fa fa-undo"></i> Annuleren
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection