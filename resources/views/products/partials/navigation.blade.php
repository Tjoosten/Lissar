<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li role="presentation" @if (Request::is('products')) class="active" @endif>
                    <a href="{{ route('producten.index') }}">Alle producten</a>
                </li>

                <li role="presentation">
                    <a href="">Eten</a>
                </li>

                <li role="presentation">
                    <a href="">Drankkaarten</a>
                </li>

                <li role="presentation">
                    <a href="">Dank consumpties</a>
                </li>
                
                <li @if (Request::is('products/create')) class="active" @endif role="presentation">
                    <a href="{{ route('producten.create') }}">Product toevoegen.</a>
                </li>
            </ul>
        </div>
    </div>
</div>