<div class="panel panel-default"> {{-- New API service --}}
    <div class="panel-heading">
        <i class="fa fa-plus" aria-hidden="true"></i> Genereer een nieuwe API sleutel.
    </div>

    <div class="panel-body"> {{-- Content --}}
        <form action="{{ route('apikeys.store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }} {{-- Form field protection --}}

            <div class="form-group @error('service', 'has-error')">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Naam van je applicatie" @input('service')>
                    @error('service')
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="fa fa-check" aria-hidden="true"></span> Toevoegen
                    </button>

                    <button class="btn btn-sm btn-link" type="reset">
                        <span class="fa fa-undo" aria-hidden="true"></span> Annuleren
                    </button>
                </div>
            </div>
        </form>
    </div> {{-- /END content --}}
</div> {{-- /END new API service --}}

{{-- User API key listing --}}
    @if ($user->apiKeys()->count() === 0) {{-- User has no keys --}}
        <div class="alert alert-info alert-important">
             <strong><i class="fa fa-info-circle"></i> Info:</strong>
              U heeft nog geen API sleutels aangemaakt.
        </div>
    @else {{-- User has keys --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-key" aria-hidden="true"></i> Uw aangemaakte sleutels.
            </div>

            <div class="panel-body"> {{-- API key listing --}}
                @php $keys = $user->apiKeys()->paginate(10) @endphp

                <div class="table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service:</th>
                                <th colspan="2">Key:</th> {{-- Colspan 2 needed for the delete function. --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keys as $key) {{-- Loop through authencated user api keys. --}}
                                <tr>
                                    <td><strong>#{{ $key->id }}</strong></td>
                                    <td>{{ $key->service }}</td>
                                    <td><code>{{ $key->key }}</code></td>
                                    <td class="text-center">
                                        <a href="" class="label label-danger"><i class="fa fa-close"></i> Verwijder</a>
                                    </td>
                                </tr>
                            @endforeach {{-- END loop--}}
                        </tbody>
                    </table>
                </div>

                {{ $keys->render() }} {{-- Pagination instance --}}
            </div> {{-- /API key listing --}}
        </div>
    @endif
{{-- /END User API key listing --}}