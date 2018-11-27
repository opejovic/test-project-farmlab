@extends ('errors.master')

@section ('title', '403')

@section ('content')
    <h1>403</h1>
    <h3 class="font-bold">Permission denied!</h3>

    <div class="error-desc">
        Sorry, you are not authorized to view this page.
            <h5>
                <button type="submit" class="btn btn-primary" onclick="window.history.go(-1)">Go back</button>
            </h5>
    </div>
@endsection