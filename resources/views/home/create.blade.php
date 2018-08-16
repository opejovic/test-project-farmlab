@extends ('layouts.master')

@section ('content')        

       
    <form class="form-signin" method="POST" action="/login">
      @csrf
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="email" class="sr-only">Email address</label>
      <input name="email" type="email" id="email" class="form-control" placeholder="Email address" required autofocus>

      <label for="password" class="sr-only">Password</label>
      <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>

      <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </div>

      @include ('layouts.errors')
    </form>

@endsection