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
                    <strong><a href="{{ route('practices.index') }}">Practices</a></strong>
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
                <a href="{{ route('practices.show', $practice->id) }}" class="text-navy">
                        <div class="ibox-title bg-primary text-center">
                            <i class="fa fa-ambulance fa-lg"></i>
                            <span><strong>{{ $practice->name }}</strong></span>
                        </div>
                        </a>
                        <div class="ibox-content">
                            <div class="team-members text-center">
                                @foreach ($practice->admin as $admin)
                                    <a href="{{ route('vets.show', [$practice->id, $admin->id]) }}">
                                        <span class="badge">Admin</span>
                                    <img alt="member" class="img-circle" src="images/profiles/{{ $admin->id }}.jpg" 
                                        onerror="if (this.src != '/images/error.jpg') this.src = '/images/error.jpg';"> 
                                    </a>
                                        <h5>{{ $admin->name }}</h5>
                                    <hr>
                                @endforeach
                            </div>
                            <h4>Info about {{ $practice->name }}</h4>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content
                                of a page when looking at its layout. The point of using Lorem Ipsum is that it has.
                            </p>
                            <div>
                                <span>Status of processed results:</span>
                                <div class="stat-percent">{{ $practice->processedResultsPercentage }}%</div>
                                <div class="progress progress-mini">
                                    <div style="width: {{ $practice->processedResultsPercentage }}%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">VETS</div>
                                    {{ count($practice->vets) }}
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    4th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">LABRESULTS</div>
                                     {{ count($practice->results) }}<i class="fa fa-level-up text-navy"></i>
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

@section ('scripts')
    @if ($errors->any())
        <script type="text/javascript">
            $('#myPracticeModal').modal('show');
        </script>
    @endif
@endsection