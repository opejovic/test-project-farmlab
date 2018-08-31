<br>
                <div class="card-header">Process the result</div>

                <div class="card-body">
                    <form method="POST" action="/labresults/{{ $result->id }}" aria-label="process">
                        @csrf

                        <div class="form-group row">
                            <label for="vet_comment" class="col-sm-4 col-form-label text-md-right">Vet comment</label>
                            <div class="col-md-6">
                                <textarea id="vet_comment" class="form-control" name="vet_comment" required autofocus></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vet_indicator" class="col-md-4 col-form-label text-md-right">Vet indicator</label>
                            <div class="col-md-6">
                                <textarea id="vet_indicator" class="form-control" name="vet_indicator" required autofocus></textarea>
                            </div>
                        </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
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
    </div>
</div>
</main>