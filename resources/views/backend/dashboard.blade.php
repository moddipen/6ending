@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs/>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-gradient-primary">
            <div class="card-body">
                <div class="text-value-lg">89.9%</div>
                <div>Widget title</div>
                <div class="progress progress-white progress-xs my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Widget helper text</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-gradient-warning">
            <div class="card-body">
                <div class="text-value-lg">12.124</div>
                <div>Widget title</div>
                <div class="progress progress-white progress-xs my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Widget helper text</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-gradient-danger">
            <div class="card-body">
                <div class="text-value-lg">$98.111,00</div>
                <div>Widget title</div>
                <div class="progress progress-white progress-xs my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Widget helper text</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-gradient-info">
            <div class="card-body">
                <div class="text-value-lg">2 TB</div>
                <div>Widget title</div>
                <div class="progress progress-white progress-xs my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Widget helper text</small>
            </div>
        </div>
    </div>

</div>
@if($matches->count() > 0)
<div class="row">
    @foreach($matches as $match)
        <div class="col-lg-4 col-sm-6">
            <div class="card" role="button">
                <div class="card-header">
                    {{ $match->matchtype->type }}               
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="success">{{ strtoupper(substr($match->team_1, 0, 3)); }}</h3>
                            <span>{{ $match->team_1 }}</span>
                        </div>
                        <div class="col-4 text-center">
                            <h3 class="success">&nbsp;</h3>
                            <span class="text-danger font-weight-bold">{{ time_string_format($match->schedule) }}</span>
                        </div>
                        <div class="col-4 text-right">
                            <h3 class="success">{{ strtoupper(substr($match->team_2, 0, 3)); }}</h3>
                            <span>{{ $match->team_2 }}</span>
                        </div>
                    </div> 
                </div>
                <div class="card-footer text-muted text-right">
                    <a href="{{ route("backend.matches.events",\Crypt::encrypt($match->matchtype_id)) }}" class="text-decoration-none"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>  
    @endforeach
</div>
@endif
<!-- / card -->
@endsection