<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info-circle"></i> Account informatie.
    </div>

    <div class="panel-body">
        <form method="POST" action="" class="form-horizontal">
            {{ csrf_field() }} {{-- CSRF field protection --}}

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i> Wijzigen
                    </button>

                    <button type="reset" class="btn btn-link btn-sm">
                        <i class="fa fa-undo"></i> Annuleren
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>