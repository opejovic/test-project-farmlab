@if ($errors->any())
    <div class="col-md-8">
        <br>
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error}}
            @endforeach
        </div>
    </div>
@endif

