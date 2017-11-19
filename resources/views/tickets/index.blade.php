@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash message view instance --}}

        <div class="row">
            @include('tickets.partials.navigation') {{-- Helpdesk navigation bar --}}

            {{-- Panels --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="fa fa-list"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1>{{ $tickets->count() }}</h1>
                                    <div>Aantal ticketten</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="fa fa-wrench"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1>{{ $tickets->where('closed', 'N')->count() }}</h1>
                                    <div>Open tickets</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="fa fa-thumbs-o-up"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1>{{ $tickets->where('closed', 'Y')->count() }}</h1>
                                    <span>Gesloten ticketten</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- /Panels --}}

            <div class="col-md-8"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Activiteits monitor:
                    </div>

                    <div class="panel-body">
                        {{-- // --}}
                    </div>
                </div>
            </div> {{-- /Content --}}

            <div class="col-md-4"> {{-- Side navigation --}}

                <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom: 10px;">
                    <li role="presentation" class="active">
                        <a href="#users" aria-controls="users" role="tab" data-toggle="tab">
                            <i class="fa fa-users"></i> Gebruikers
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#admins" aria-controls="admins" role="tab" data-toggle="tab">
                            <i class="fa fa-users"></i> Admins
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#category" aria-controls="category" role="tab" data-toggle="tab">
                            <i class="fa fa-tags"></i> Categorieen
                        </a>
                    </li>
                </ul>

                <div class="tab-content"> {{-- Side navigation panels --}}

                    <div role="tabpanel" class="list-group tab-pane fade in active" id="users"> {{-- Tab panel for the normal users. --}}
                        <a href="#" class="list-group-item disabled">
                            <span>Gebruikers</span>
                            <span class="pull-right text-muted small">
                                <em> Open / Gesloten </em>
                            </span>
                        </a> 

                        @php ($normalUsers = $users->role('user')->paginate(10))

                        @if (count($normalUsers) > 0)
                            @foreach ($normalUsers as $normalUser) {{-- Loop through the users --}}
                                <a href="#" class="list-group-item"> {{-- TODO: Implement view for the user specific tickets. --}}
                                    {{ $normalUser->name }}

                                    <span class="pull-right text-muted small">
                                        <em>
                                            {{ $tickets->where('author_id', $normalUser->id)->where('closed', 'N')->count() }} /
                                            {{ $tickets->where('author_id', $normalUser->id)->where('closed', 'Y')->count() }}
                                        </em>
                                    </span>
                                </a>
                            @endforeach {{-- END LOOP --}} 
                        @else 
                            <a href="#" class="list-group-item">
                                <i>Er zijn geen gebruikers in het systeem.</i>
                            </a>
                        @endif

                        {{ $normalUsers->render() }} {{-- Pagination view instance --}}
                    </div> {{-- End users tab --}}

                    <div role="tabpanel" class="tab-pane list-group fade in" id="admins"> {{-- Tab panel for admin users. --}}
                        <a href="#" class="list-group-item disabled">
                            <span>Adminstrators</span>

                            <span class="pull-right text-muted small">
                                <em> Open / Gesloten </em>
                            </span>
                        </a>

                        @php ($adminUsers = $users->role('admin')->paginate(20))

                        @if (count($adminUsers) > 0)
                            @foreach ($adminUsers as $adminUser)
                                <a href="#" class="list-group-item"> {{-- Loop through the admin --}}
                                    {{ $adminUser->name }} 

                                    <span class="pull-right text-muted small">
                                        <em>
                                            {{ $tickets->where('author_id', $adminUser->id)->where('closed', 'N')->count() }} /
                                            {{ $tickets->where('author_id', $adminUser->id)->where('closed', 'Y')->count() }}
                                        </em>
                                    </span>
                                </a> {{-- END LOOP --}}
                            @endforeach
                        @else
                            <a href="#" class="list-group-item">
                                <i>Er zijn geen administrators in het systeem</i>
                            </a>
                        @endif

                        {{ $adminUsers->render() }}
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="category"> {{-- Tab panel for the helpdesk categories. --}} 
                        <a href="" class="list-group-item disabled">
                            <span>Categorieen:</span>

                            <span class="pull-right text-muted small">
                                <em> Open / Gesloten </em>
                            </span>
                        </a>

                        @if (count($categories) > 0)  {{-- Categories found --}}
                            @foreach ($categories as $category) {{-- Loop through the categories --}}
                                <a href="#" class="list-group-item">
                                    {{ $category->name }}

                                    <span class="pull-right text-muted small">
                                        <em>
                                            {{ $tickets->where('closed', 'N')->where('category_id', $category->id)->count() }} / 
                                            {{ $tickets->where('closed', 'Y')->where('category_id', $category->id)->count() }}
                                        </em>
                                    </span>
                                </a> 
                            @endforeach {{-- END LOOP --}}
                        @else {{-- No Categories found --}}
                            <a href="#" class="list-group-item">
                                <i>Er zijn geen categorieen in het systeem</i>
                            </a>
                        @endif

                        {{ $categories->render() }} {{-- Pagination view instance. --}}
                    </div>
                </div> {{-- /Side navigation panels --}}

            </div> {{-- /Side navigation --}}
        </div>
    </div>
@endsection