<div class="col-md-12"> {{-- Navigation bar --}}
    <div class="panel panel-default">
        <div class="panel-body">

            <ul class="nav nav-pills">
                <li role="presentation">
                    <a href="">
                        Mijn ticketten
                        <span class="badge">{{ $tickets->where('author_id', auth()->user()->id)->count() }}
                    </a>
                </li>
                <li role="presentation">
                    <a href="#">
                        Actieve ticketten 
                        <span class="badge">{{ $tickets->where('closed', 'N')->count() }}</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#">
                        Gesloten ticketten 
                        <span class="badge">{{ $tickets->where('closed', 'Y')->count() }}</span>
                    </a>
                </li>
                <li role="presentation" @if (Request::is('tickets/dashboard')) class="active" @endif>
                    <a href="{{ route('tickets.index') }}">Dashboard</a>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Configuratie <span class="caret"></span>
                    </a>
                                
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="">Statussen</a></li>
                        <li><a href="{{ route('priorities.index') }}">Prioriteiten</a></li>
                        <li><a href="">Vrijwilligers</a></li>
                        <li><a href="{{ route('categories.index') }}">Categorieen</a></li>
                        <li><a href="">Administrators</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div> {{-- /Navigation bar --}}