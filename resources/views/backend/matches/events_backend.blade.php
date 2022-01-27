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
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Events</th>
                            <th scope="col"></th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($get_match_events as $event)
                                <tr>
                                    <td>{{ $event->matchtypeevent->event_types->type }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="input-group col-lg-6 input-group-sm mb-3">
                                                @if($event->matchtypeevent->event_types->type == "Toss")
                                                    <select class="form-control select-winner amount-customization" {{ $event->is_settled == 1 ? 'disabled' : '' }} name="result">
                                                        <option value="">choose winner</option>
                                                        <option {{ (!empty($event->match_result) && $event->match_result->result == $event->match->team_1 ) ? ' selected'  : ''}} value="{{ $event->match->team_1 }}">{{ $event->match->team_1 }}</option>
                                                        <option {{ (!empty($event->match_result) && $event->match_result->result == $event->match->team_2 ) ? ' selected'  : ''}} value="{{ $event->match->team_2 }}">{{ $event->match->team_2 }}</option>
                                                    </select>
                                                    <div class="invalid-feedback order-last">This field is required.</div>
                                                    <div style="display:none; cursor:pointer;" class="input-group-append" data-id="{{ $event->id }}">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">
                                                            <i class="fas fa-user-edit"></i>
                                                        </span>
                                                    </div>
                                                @else
                                                    <input type="text" value="{{ !empty($event->match_result) ? $event->match_result->result : "" }}" {{ $event->is_settled == 1 ? 'disabled' : '' }} data-val-required="Required" name="result" class="form-control amount-customization" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                    <div class="invalid-feedback order-last">This field is required.</div>
                                                    <div style="display:none; cursor:pointer;" class="input-group-append" data-id="{{ $event->id }}">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">
                                                            <i class="fas fa-user-edit"></i>
                                                        </span>
                                                    </div>
                                                @endif                                                
                                            </div>                                           
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox row col-lg-6">
                                            @if($event->status == 0)
                                                <input data-class="btn-block" data-id="{{ $event->matchtypeevent->id }}" data-width="100%" id="kv-toggle-demo" value="1" type="checkbox" checked data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="warning">
                                            @else
                                                <input data-class="btn-block" data-id="{{ $event->matchtypeevent->id }}" data-width="100%" id="kv-toggle-demo" value="0" type="checkbox" data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="warning">
                                            @endif
                                        </div>
                                    </td>                                           
                                </tr>
                            @endforeach                       
                        </tbody>
                    </table>
                </div>
            </div>   
            
            @if($check_id_match_settled->is_settled == 1)
                <div class="d-flex justify-content-center border">
                    <div class="p-2 bd-highlight text-info">Match has been setteled down!</div>
                </div>
            @else
                <div class="d-flex justify-content-center border">
                    {{ html()->form('POST', route('backend.settlements.store'))->class('form-horizontal')->id('validate-form')->open() }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="hidden" value="{{ $match_id }}" name="match_id">
                        <button type="button" class="btn btn-success" onClick="validate_form()" data-toggle="tooltip" title="" data-original-title="Make settlement">
                        <i class="fas fa-balance-scale" data-original-title="" title=""></i>
                        &nbsp; Settlement
                        </button>
                    </div>
                </div> 
            @endif                               
                    
        </div>
    </div>   
</div>
@endsection

@push ('after-styles')
<style>
    .input-group-text{ height : calc(1.8125rem + 0px) !important; }
</style>
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}"> --}}
@endpush

@push ('after-scripts')
<script>
    var routeTypeUpdate = '{{ route("backend.matches.update-type") }}'; 
    var routeMatcheventResultUpdate = '{{ route("backend.matchevents.update-result") }}'; 
</script>

<script type="text/javascript" src="{{ asset('js/bootstrap2-toggle.min.js') }}"></script>
<script src="{{ asset('js/matches-events-backend.js') }}"></script>
@endpush