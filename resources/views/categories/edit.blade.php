@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            @include('tickets.partials.navigation')

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> {{-- Panel heading --}}
                        <i class="fa fa-cogs fa-fw"></i> <strong>Wijzig:</strong> {{ $category->name }}

                        <a href="{{ route('categories.index') }}" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-undo"></i> Keer terug</i>
                        </a>
                    </div> {{-- /END heading --}}

                    <div class="panel-body"> {{-- Form content --}}

                        <form>
                        </form>

                    </div> {{-- /END form content --}}
                </div>
            </div>
        </div>
    </div>
@endsection