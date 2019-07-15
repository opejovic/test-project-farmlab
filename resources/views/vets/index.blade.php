@extends('layouts.app')

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

                <a href="{{ route('vets.show', $vet->hash_id) }}">

                    <img alt="image" class="img-circle" src="/storage/{{ $vet->avatar() }}">

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
                        @if ($vet->is_verified)
                            <a class="btn btn-xs btn-primary">{{ __('Verified') }}</a>
                        @else
                            <a class="btn btn-xs btn-warning">{{ __('Not Verified') }}</a>
                        @endif 
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

@section ('scripts')
    @if ($errors->any())
        <script type="text/javascript">
            $('#myModal').modal('show');
        </script>
    @endif
@endsection