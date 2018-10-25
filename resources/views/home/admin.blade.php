@extends('layouts.app')

@section('content')
  <a href="{{ route('members.create') }}" class="btn btn-md btn-secondary">Add new lab member</a><hr>
  <a href="{{ route('members.index') }}" class="btn btn-md btn-secondary">See lab members</a><hr>
  <a href="{{ route('practice.create') }}" class="btn btn-md btn-secondary">Add new practice</a><hr>
  <a href="{{ route('practice.index') }}" class="btn btn-md btn-secondary">See practices</a>
@endsection
