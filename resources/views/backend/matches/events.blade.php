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
                    {{ $event->matchtypeevent->match_types->type }}               
                </div>
                <div class="card-body text-center">
                    <h5 class="success">{{ $event->matchtypeevent->event_types->type }}</h5>
                    <h6 class="card-text small">* Every {{ $event->matchtypeevent->bet_coin }} coin can get you {{ $event->matchtypeevent->win_coin }} coin on winning </h6>  
                    @php
                        $check = \App\Models\Bet::where(['match_event_id' => $event->id,'user_id'=>auth()->user()->id])->first();                        
                    @endphp   
                    @if(!empty($check)) 
                        <div class="form-group mx-sm-3 mb-3">
                            <h5 class="success text-success">Bet Placed!</h5>
                            <a href="#">&nbsp</a>
                        </div>    
                    @elseif($event->status == 1)
                        <div class="form-group mx-sm-3 mb-3">
                            <h5 class="success text-danger">Betting is disabled!</h5>
                            <a href="#">&nbsp</a>
                        </div>                  
                    @else 
                        <div class="form-group mx-sm-3 mb-2">
                            <div class="input-group">
                                @if($event->matchtypeevent->event_types->type == "Toss")
                                    <select class="form-control form-control-sm result" name="result">
                                        <option value="">Choose team</option>
                                        <option value="{{ $event->match->team_1 }}">{{ $event->match->team_1 }}</option>
                                        <option value="{{ $event->match->team_2 }}">{{ $event->match->team_2 }}</option>
                                    </select>  
                                @elseif ($event->matchtypeevent->event_types->type == "One day Khada – 61 runs" || $event->matchtypeevent->event_types->type == "T20 Khada – 31 runs")
                                    <input type="text" class="form-control form-control-sm result_low" placeholder="Low Score" name="result_low"> 
                                    <input type="text" class="form-control form-control-sm result_high" placeholder="High Score" name="result_high"> 
                                @else
                                    <input type="text" class="form-control form-control-sm result" placeholder="Enter value" name="result"> 
                                @endif                                
                                <input type="text" class="form-control form-control-sm bet-coins" placeholder="Enter Coins" name="bet_coin">
                                <div class="invalid-feedback"></div>
                            </div>                         
                            <input type="hidden" name="match_event_id" value="{{ $event->id }}">                            
                        </div>
                        <a href="#" class="btn btn-sm btn-success place-bet">BET</a> 
                    @endif                              
                                          
                </div>
                <div class="card-footer text-muted text-right">
                    @php
                        $get_count = \App\Models\Bet::where(['match_event_id' => $event->id])->get();                        
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