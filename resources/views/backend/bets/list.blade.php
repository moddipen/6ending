@if($no_record_flag == 1)
    @foreach($get_bets as $bet)
        <div class="card bg-light mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        {{ $bet->match_event->matchtypeevent->event_types->type }}
                    </div>
                    <div class="col-sm-3">
                        {{ $bet->result }}
                    </div>
                    <div class="col-sm-3">
                        {{ $bet->bet_coins }} Coins
                    </div>
                </div>                        
            </div>
        </div>
    @endforeach
@else
    <div class="card bg-light mb-2">
        <div class="card-body">
            <div class="text-center">
                No bets are placed.
            </div>                        
        </div>
    </div>
@endif