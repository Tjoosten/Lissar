@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            @include('products.partials.navigation') {{-- Products navigation. --}}
        </div>
    </div>
@endsection