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
            <div class="row py-4">
                <div class="col-xs-3">
                    <label class="form-control-label" for="input-name">{{ __('Start Date') }}</label>
                </div>
                <div class="col-xs-2">
                    <div class="input-group col-sm-10 date datetime_from" id="schedule" data-target-input="nearest">
                        {{ html()->text('schedule')->placeholder('Date & Time')->class('form-control form-control-sm datetimepicker-input') }}
                        <div class="input-group-append" data-target="#schedule" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div> 
                </div>

                <div class="col-xs-3">
                    <label class="form-control-label" for="input-name">{{ __('End Date') }}</label>
                </div>
                <div class="col-xs-2">
                    <div class="input-group col-sm-10 date datetime_to" id="schedule-1" data-target-input="nearest">
                        {{ html()->text('schedule-1')->placeholder('Date & Time')->class('form-control form-control-sm datetimepicker-input') }}
                        <div class="input-group-append" data-target="#schedule-1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-2">
                    <button type="submit" class="btn btn-success search btn-sm" data-toggle="tooltip" title="">
                        <i class="fas fa-search"></i>
                        Search
                    </button>                
                </div>             
            </div>
            <div class="row mt-4">
                <div class="col">                  
                    <table class="table table-hover table-responsive-sm" id="betting-history-list">
                        <thead>
                            <tr>
                                <th>Match</th>
                                <th>Start Time</th>
                                <th>Settled Time</th>
                                <th>Profit / Loss</th>   
                                <th>Action</th>                                                                                               
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
<div class="modal fade betting-detail" id="detail-bet" role="dialog" tabindex="-1" aria-labelledby="betting-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>                
            <div class="modal-body bet-placed-list overflow-scroll"> 
                <table class="bets table table-responsive-sm dataTable no-footer">
                    <thead>
                        <tr role="row">
                            <th>Bet ID</th>
                            <th>Selection</th>
                            <th>Placed</th>
                            <th>Profit/Loss</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>                              
            </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>                               
        </div>    
    </div>
</div>
@endsection

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-4-datetime-picker/css/tempusdominus-bootstrap-4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push ('after-scripts')
<script>
    var profitlossList = '{{ route("backend.profit.loss.report.datatable") }}';        
</script>
<!-- DataTables Core and Extensions -->
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap2-toggle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap-4-datetime-picker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('js/profit-loss-management.js') }}"></script>
@endpush