@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs/>
@endsection

@section('content')

@if($get_match_events->count() > 0)
<div class="row">
    @foreach($get_match_events as $event)
        <div class="col-lg-4 col-sm-6">
            <div class="card" role="button">
                <div class="card-header">
                    {{ $event->match_types->type }}               
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="success">{{ $event->event_types->type }}</h5>
                            <h6 class="small">* Every {{ $event->bet_coin }} coin can get you {{ $event->win_coin }} coin on winning </h6>                                                       
                        </div>
                        <div class="col-4 text-right">
                            <a href="#" class="btn btn-success">BET</a>
                        </div>
                    </div> 
                </div>
                <div class="card-footer text-muted text-right">
                    <span class="float-left">Total Spots: 100</span>
                    <span class="float-right">Active</span>                    
                </div>
            </div>
        </div>  
    @endforeach
</div>
@endif
<!-- / card -->
@endsection