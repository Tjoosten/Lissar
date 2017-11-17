<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-key"></i> Account beveiliging.
    </div>

    <div class="panel-body">

        <form action="" class="form-horizontal">
            {{ csrf_field() }} {{-- Form field protection --}}

            <div class="form-group">
                <label class="control-label col-md-3">Nieuw wachtwoord: <span class="text-danger">*</span></label>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">Herhaal wachtwoord: <span class="text-danger">*</span></label>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i> Aanpassen
                    </button>

                    <button type="reset" class="btn btn-sm btn-link">
                        <i class="fa fa-undo"></i> Annuleren
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>