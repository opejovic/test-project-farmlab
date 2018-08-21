@extends ('layouts.master')

@section ('content')

  <table class="table table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Herd</th>
      <th scope="col">Date of arrival</th>
      <th scope="col">Date of test</th>
      <th scope="col">Animal ID</th>
      <th scope="col">Lab code</th>
      <th scope="col">Test name</th>
      <th scope="col">Type of samples</th>
      <th scope="col">Reading</th>
      <th scope="col">Interpretation</th>
      <th scope="col">Farmer name</th>
      <th scope="col">Vet comment</th>
      <th scope="col">Vet indicator</th>
      <th scope="col">Practice name</th>
    </tr>
  </thead>
      @foreach ($results as $result)
  <tbody>

    <tr>
      <th scope="row">{{ $result->id }}</th>
      <td>{{ $result->herd_number}}</td>
      <td>{{ $result->date_of_arrival}}</td>
      <td>{{ $result->date_of_test}}</td>
      <td>{{ $result->animal_id}}</td>
      <td>{{ $result->lab_code}}</td>
      <td>{{ $result->test_name}}</td>
      <td>{{ $result->type_of_samples}}</td>
      <td>{{ $result->reading}}</td>
      <td>{{ $result->interpretation}}</td>
      <td>{{ $result->farmer_name}}</td>
      <td>{{ $result->vet_comment}}</td>
      <td>{{ $result->vet_indicator}}</td>
      <td>{{ $result->practice_name}}</td>

    </tr>
 
  </tbody>
  @endforeach
</table> 

@endsection



