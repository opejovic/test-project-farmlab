<div>
<a data-toggle="modal" data-target="#myLabresultModal" id="open" class="btn btn-white" type="button"><i class="fa fa-pencil"></i>
Process the result
</a>
     <div class="modal inmodal" id="myLabresultModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-ambulance modal-icon"></i>
                <h4 class="modal-title">Process This Lab Result</h4>
                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
            </div>
            <div class="modal-body">
            <form method="POST" 
                  action="{{ route('labresults.update', [$practice->id, $labresult->id]) }}" 
                  aria-label="update" id="myForm">
                  @method('PATCH')
                  @csrf

            <div class="form-group{{ $errors->has('vet_comment') ? ' has-error' : '' }} row">
                <label for="vet_comment" class="col-sm-4 col-form-label text-md-right">Vets Comment</label>
                <div class="col-md-8">
                    <textarea name="vet_comment" class="form-control" id="vet_comment" value="{{ old('vet_comment') }}" required="" rows="5"></textarea>
                    @if ($errors->has('vet_comment'))
                        <label class="control-label">
                            <strong>{{ $errors->first('vet_comment') }}</strong>
                        </label>
                    @endif
                </div>
            </div>                            

            <div class="form-group{{ $errors->has('vet_indicator') ? ' has-error' : '' }} row">
                <label for="vet_indicator" class="col-sm-4 col-form-label text-md-right">Vets Indicator</label>
                <div class="col-md-8">
                    <textarea name="vet_indicator" class="form-control" id="vet_indicator" value="{{ old('vet_indicator') }}" required="" rows="5"></textarea>
                    @if ($errors->has('vet_indicator'))
                        <label class="control-label">
                            <strong>{{ $errors->first('vet_indicator') }}</strong>
                        </label>
                    @endif
                </div>
            </div>
        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Dismiss</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            
            </div>
        </div>
    </div>  
</div>
