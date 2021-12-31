<div>
    <div class="row mt-4">
        <div class="col">
            <input type="text" class="form-control my-2" placeholder=" Search" wire:model="searchTerm" />
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th>Match Type</th>
                        <th>Event Type</th>
                        <th>Bet Coin</th>
                        <th>Win Coin</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->match_types->type}}</td>
                                    <td>{{ $event->event_types->type}}</td>
                                    <td>{{ $event->bet_coin}}</td>
                                    <td>{{ $event->win_coin}}</td>                                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $events->total() !!} {{ __('labels.backend.total') }}
                    </div>
                </div>
                <div class="col-5">
                    <div class="float-right">
                        {!! $events->links() !!}
                    </div>
                </div>
            </div>
        </div>