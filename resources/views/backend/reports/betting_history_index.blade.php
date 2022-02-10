@extends ('backend.layouts.app')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ $module_title }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> {{ $module_title }}
                    <small class="text-muted">{{ __('labels.backend.users.index.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ $module_title }}
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
        <div>
            <div class="row mt-4">
                <div class="col">                  
                    <table class="table table-hover table-responsive-sm" id="credit-debit-list">
                        <thead>
                            <tr>
                                <th>Bet ID</th>
                                <th>Username</th>
                                <th>Match</th>
                                <th>Event</th>
                                <th>Selection</th>                                
                                <th>Bet Placed</th>                                
                                {{-- <th>Points</th> --}}
                                <th>Profit/Loss</th>                                                                
                            </tr>
                        </thead>                            
                    </table>
                </div>
            </div>            
        </div>
    </div>
    <div class="card-footer">
        
    </div>
</div>
@endsection

@push ('after-styles')
<style>
    .input-group-text{ height : calc(1.8125rem + 0px) !important; }
</style>
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push ('after-scripts')
<script>
    var creditList = '{{ route("backend.credit.debit.report.datatable") }}';        
</script>
<!-- DataTables Core and Extensions -->
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap2-toggle.min.js') }}"></script>
<script src="{{ asset('js/credit-debit-management.js') }}"></script>
@endpush