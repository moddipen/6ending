@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs/>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-gradient-info text-white">
            <div class="card-body">
                <div class="text-value-lg">{{ $remaining_coins; }}</div>
                <div>Remainig Coins</div>
                {{-- <div class="progress progress-xs my-2">
                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Widget helper text</small> --}}
            </div>
        </div>
    </div>
    <!-- betcoins card start -->
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-gradient-danger text-white">
            <div class="card-body">
                <div class="text-value-lg">{{ $bet_coins; }}</div>
                <div>Bet Coins</div>
                {{-- <div class="progress progress-xs my-2">
                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Widget helper text</small> --}}
            </div>
        </div>
    </div>
    <!-- betcoins card end -->

    <!-- total coins card start -->
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-gradient-success text-white">
            <div class="card-body">
                <div class="text-value-lg">{{ $total_coins; }}</div>
                <div>Total Coins</div>
                {{-- <div class="progress progress-xs my-2">
                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Widget helper text</small> --}}
            </div>
        </div>
    </div>
    <!-- total coins card end -->

    {{-- <div class="col-sm-6 col-lg-3">
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
    </div> --}}

</div>
@if($matches->count() > 0)
<div class="row">
    @foreach($matches as $match)
        <div class="col-lg-4 col-sm-6">
            <div class="card" role="button"  onClick="redirect('{{ route("backend.matches.events",['id'=>\Crypt::encrypt($match->matchtype_id),'match_id'=>$match->id]) }}')">
                <div class="card-header">
                    {{ $match->matchtype->type }}               
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="success">{{ $match->shortcode_1  }}</h3>
                            <span>{{ $match->team_1 }}</span>
                        </div>
                        <div class="col-4 text-center">
                            <h3 class="success">&nbsp;</h3>
                            <span class="font-weight-bold">{!! time_string_format($match->schedule) !!}</span>
                        </div>
                        <div class="col-4 text-right">
                            <h3 class="success">{{ $match->shortcode_2  }}</h3>
                            <span>{{ $match->team_2 }}</span>
                        </div>
                    </div> 
                </div>
                <div class="card-footer text-muted text-right">
                    <a href="{{ route("backend.matches.events",['id'=>\Crypt::encrypt($match->matchtype_id),'match_id'=>$match->id]) }}" class="text-decoration-none"><i class="fa fa-arrow-right"></i></a>
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
        function redirect(url){
            window.location.href = url;
        } 
    </script>    
@endpush