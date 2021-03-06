<a data-toggle="modal" data-target="#myModal" id="open">
    <button class="btn btn-primary btn-rounded" type="button">
        <i class="fa fa-user-plus fa-lg"></i> Add Vet
    </button>
</a>
     <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-user modal-icon"></i>
                <h4 class="modal-title">Add new vet</h4>
                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
            </div>
            <div class="modal-body">
            <form role="form" method="POST" action="{{ route('vets.store') }}" id="form">
            @csrf

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                <div class="col-md-8">
                    <input name="name" type="text" class="form-control" id="name" required>
                    @if ($errors->has('name'))
                        <label class="control-label">
                            <strong>{{ $errors->first('name') }}</strong>
                        </label>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
                <div class="col-md-8">
                    <input name="email" type="email" class="form-control" id="email" required>
                    @if ($errors->has('email'))
                        <label class="control-label">
                            <strong>{{ $errors->first('email') }}</strong>
                        </label>
                    @endif                    
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Dismiss</button>
                <button type="submit" id="ajaxSubmit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            
        </div>
    </div>
