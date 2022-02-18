@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ $module_title }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection


@section('content')
@if($get_match_events->count() == 0)
<div class="row">
    <div class="col">
        <div class="alert text-center alert-danger" role="alert">
            There are no events available.
        </div>
    </div>
</div>
@endif
@if($get_match_events->count() > 0)
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="float-right">
            <a data-toggle="modal" data-backdrop="false" data-target="#placed-bet" href="#" class="btn btn-success bet-placed" data-toggle="tooltip" title="" data-original-title="Placed Bets">
                Bets
            </a>
        </div>
    </div>    
</div>
<div class="modal fade placed-bet" id="placed-bet" role="dialog" tabindex="-1" aria-labelledby="placed-bet">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Betting Placed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>                
            <div class="modal-body bet-placed-list overflow-scroll"> 
                                                    
            </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>                               
        </div>    
    </div>
</div> 
<div class="row">
    @foreach($get_match_events as $event)
        <div class="col-lg-4 col-sm-6">
            <div class="card" role="button">
                <div class="card-header">
                    {{ $event->matchtypeevent->match_types->type }}               
                </div>
                <div class="card-body text-center">
                    <h5 class="">{{ $event->matchtypeevent->event_types->type }}</h5>
                    <h6 class="card-text small">* Every {{ $event->matchtypeevent->bet_coin }} coin can get you {{ $event->matchtypeevent->win_coin }} coin on winning </h6>  
                    {{-- @php
                        $check = \App\Models\Bet::where(['match_event_id' => $event->id,'user_id'=>auth()->user()->id])->first();                        
                    @endphp   
                    @if(!empty($check)) 
                        <div class="form-group mx-sm-3 mb-3">
                            <h5 class="success text-success">Bet Placed!</h5>
                            <a href="#">&nbsp</a>
                        </div>    
                    @else --}}
                    @if($event->status == 1)
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
                                    <input type="hidden" class="form-control form-control-sm type" name="type" value="{{ $event->matchtypeevent->event_types->type }}"> 
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
        var placed_bet = '{{  route('backend.bets.placed',["match_id"=>$match_id]) }}';                    
    </script>
    <script src="{{ asset('js/match-events-front.js') }}"></script>
@endpush