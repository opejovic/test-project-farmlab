<div class="col-md-4">
    <div class="card">
        <div class="card-header">Process the result</div>

        <div class="card-body">
            <form method="POST" action="{{ route('labresults.update', $labresult->id) }}"
                  aria-label="update">
                @method('PATCH')
                @csrf

                <div class="form-group row">
                    <label for="vet_comment" class="col-sm-6 col-form-label">Vet
                        comment</label>
                    <div class="col-md-12">
                        <textarea id="vet_comment" class="form-control" name="vet_comment" rows="6" required
                                  autofocus></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="vet_indicator" class="col-md-6 col-form-label">Vet
                        indicator</label>
                    <div class="col-md-12">
                        <textarea id="vet_indicator" class="form-control" name="vet_indicator" rows="6" required
                                  autofocus></textarea>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-secondary">
                            Process the result
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@include ('layouts.errors')

