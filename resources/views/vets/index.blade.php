@extends('layouts.app')

{{-- @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                                <tr>
                                    <td class="card-header text-center border-top-0">Id</td>
                                    <td class="card-header text-center border-top-0">Vet name</td>
                                    <td class="card-header text-center border-top-0">Created at</td>
                                    <td class="card-header text-center border-top-0">Status</td>
                                </tr>
                                @foreach ($vets as $vet)
                                <tr>
                                    <td class="text-capitalize border-bottom-1">{{ $vet->id }}</td>
                                    <td class="text-capitalize border-bottom-1">
                                        <a href="{{ route('vets.show', $vet->id)  }}">{{ $vet->name }}</a>
                                    </td>
                                    <td class="text-capitalize border-bottom-1">{{ $vet->created_at }}</td>
                                    <td class="text-capitalize border-bottom-1">{{ $vet->status }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="card-footer">{{ $vets->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@section ('pageTitle')
    Team
@endsection

@section ('content')
   <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-8">
            <h2>Team</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home')}}">Home</a>
                </li>
                <li class="active">
                    <strong>Team Members</strong>
                </li>                
        </ol>

        </div>
            <div class="col-lg-4">
                <div class="title-action">
                    @include ('vets.modalCreate')
                </div>
            </div>
        </div>

    </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @foreach ($vets as $vet)
            <div class="col-lg-3">
                <div class="contact-box center-version">

                <a href="{{ route('vets.show', $vet->id) }}">

                    <img alt="image" class="img-circle" src="images/profiles/{{ $vet->id }}.jpg" 
                        onerror="if (this.src != '/images/error.jpg') this.src = '/images/error.jpg';">

                    <h3 class="m-b-xs"><strong>{{ $vet->name }}</strong></h3>

                    <div class="font-bold">{{ __('Vet') }}</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        @if ($vet->status === \App\Models\User::VERIFIED)
                            <a class="btn btn-xs btn-primary">
                        @else
                            <a class="btn btn-xs btn-warning">
                        @endif 
                            {{ ucfirst(strtolower(str_replace('_', ' ', $vet->status)))  }}</a>
                    </div>
                </div>
            </div>
            </div>
                @endforeach

        </div>
            <div class="text-center">
                {{ $vets->links() }}
            </div>
        </div>



@endsection