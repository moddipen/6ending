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
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">{{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.users.index.sub-title') }}
                </div>
            </div>

            <div class="col-6 col-sm-4">
                <div class="float-right">
                    <x-buttons.create route='{{ route("backend.$module_name.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}"/>

                    <!-- <div class="btn-group" role="group" aria-label="Toolbar button groups">
                        <div class="btn-group" role="group">
                            <button id="btnGroupToolbar" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupToolbar">
                                <a class="dropdown-item" href="{{ route("backend.$module_name.trashed") }}">
                                    <i class="fas fa-eye-slash"></i> View trash
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('labels.backend.users.fields.name') }}</th>
                                <th>{{ __('labels.backend.users.fields.email') }}</th>
                                <th>{{ __('labels.backend.users.fields.status') }}</th>
                                <th>{{ __('labels.backend.users.fields.roles') }}</th>
                                <th class="text-right">{{ __('labels.backend.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade credit-point" id="credit-point" role="dialog" tabindex="-1" aria-labelledby="credit-point">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('backend.credits.update') }}" id="credit-points-update" method="post">
                @csrf
                <input type="hidden" name="type" value="credit" />
                <input type="hidden" name="user_id" id="user_id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Credit Points</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <div class="modal-body"> 
                    <ul class="list-group list-group-flush one-time-charge-row list my--3">                                        
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <small>Points</small>
                                    <input type="text" id="points" name="points" class="form-control-sm m-bot15 form-control" value="">                                        
                                    <div class="invalid-feedback"></div>
                                </div>                                                                                      
                            </div>
                        </li>
                    </ul>                  
                </div>   
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary credit-points-button">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> 
            </form>                   
        </div>    
    </div>
</div> 
<div class="modal fade debit-point" id="debit-point" role="dialog" tabindex="-1" aria-labelledby="debit-point">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('backend.credits.update') }}" id="debit-points-update" method="post">
                @csrf
                <input type="hidden" name="type" value="debit" />
                <input type="hidden" name="user_id" id="user_id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Debit Points</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <div class="modal-body"> 
                    <ul class="list-group list-group-flush one-time-charge-row list my--3">                                        
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <small>Points</small>
                                    <input type="text" id="points" name="points" class="form-control-sm m-bot15 form-control" value="">                                        
                                    <div class="invalid-feedback"></div>
                                </div>                                                                                      
                            </div>
                        </li>
                    </ul>                  
                </div>   
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary debit-points-button">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> 
            </form>                   
        </div>    
    </div>
</div> 
@endsection

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">

@endpush

@push ('after-scripts')
<script>
    var userList = '{{ route("backend.$module_name.index_data") }}';
</script>
<!-- DataTables Core and Extensions -->
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('js/user-module.js') }}"></script>
@endpush
