<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info-circle"></i> Account informatie.
    </div>

    <div class="panel-body">
        <form method="POST" action="" class="form-horizontal">
            {{ csrf_field() }} {{-- CSRF field protection --}}
        </form>
    </div>
</div>