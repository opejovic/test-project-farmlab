@extends('layouts.app')

@section('pageTitle')
    Practices
@endsection 
  
 
@section ('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Practice teams</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <strong><a href="{{ route('practice.index') }}">Practices</a></strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                @include ('practice.modalCreate')
            </div>
        </div>
    </div>
    </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            @foreach ($practices as $practice)
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">NEW</span>
                            <h5>{{ $practice->name }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members text-center">
                                @foreach ($practice->admin() as $admin)
                                    <img alt="member" class="img-circle" src="images/profiles/{{ $admin->id }}.jpg" 
                                        onerror="if (this.src != '/images/error.jpg') this.src = '/images/error.jpg';"> 
                                        <h5>{{ $admin->name }}</h5>
                                    <a href="{{ route('vets.show', $admin->id) }}">
                                        <span class="label label-success">Admin</span>
                                    </a>
                                    <hr>
                                @endforeach
                            </div>
                            <h4>Info about {{ $practice->name }}</h4>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content
                                of a page when looking at its layout. The point of using Lorem Ipsum is that it has.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">VETS</div>
                                    {{ count($practice->vets()) }}
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    4th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">FARMERS</div>
                                     50<i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                     </div>
                    </div>
                     @endforeach
                </div>
                <div class="text-center">
                    {{ $practices->links() }}
                </div>
            </div>

@endsection