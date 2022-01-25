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
                <div class="card-body text-center">
                    <h5 class="success">{{ $event->event_types->type }}</h5>
                    <h6 class="card-text small">* Every {{ $event->bet_coin }} coin can get you {{ $event->win_coin }} coin on winning </h6>  
                    @php
                        $check = \App\Models\Bet::where(['match_id' => $match_id,'eventtype_id'=>$event->eventtype_id,'user_id'=>auth()->user()->id])->first();                        
                    @endphp   
                    @if(!empty($check)) 
                        <div class="form-group mx-sm-3 mb-3">
                            <h5 class="success text-success">Bet Placed!</h5>
                            <a href="#">&nbsp</a>
                        </div>                        
                    @else 
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control form-control-sm bet-coins" name="bet_coin">
                            <div class="invalid-feedback"></div>
                            <input type="hidden" name="match_id" value="{{ $match_id }}">
                            <input type="hidden" name="eventtype_id" value="{{ $event->eventtype_id }}">
                        </div>
                        <a href="#" class="btn btn-sm btn-success place-bet">BET</a> 
                    @endif                              
                                          
                </div>
                <div class="card-footer text-muted text-right">
                    @php
                        $get_count = \App\Models\Bet::where(['match_id' => $match_id,'eventtype_id'=>$event->eventtype_id])->get();                        
                    @endphp 
                    <span class="float-left">Total Spots: <span class="spot-count">{{ $get_count->count()  }}</span></span>
                    <span class="float-right">Active</span>                    
                </div>
            </div>
        </div>  
    @endforeach
</div>
@endif
<!-- / card -->
@endsection

@push ('after-scripts')
    <script>
        var bet_url = '{{  route('backend.bets.store') }}';
        var match_id = '<?php echo $match_id; ?>';        
    </script>
    <script src="{{ asset('js/match-events-front.js') }}"></script>
@endpush