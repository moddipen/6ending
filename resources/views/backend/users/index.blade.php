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
                    <i class="{{$module_icon}}"></i> {{ __('labels.backend.users.index.title') }}
                    <small class="text-muted">{{ __('labels.backend.users.index.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.users.index.sub-title') }}
                </div>
            </div>

            <div class="col-5">
                <div class="float-right">
                    <x-buttons.create route='{{ route("backend.$module_name.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}" />
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
        <div>
            <div class="row mt-4">
                <div class="col">
                    {{-- <input type="text" class="form-control my-2" placeholder=" Search" wire:model="searchTerm" /> --}}
                    
                    <table class="table table-hover table-responsive-sm" id="user-list">
                        <thead>
                            <tr>
                                <th>{{ __('labels.backend.users.fields.name') }}</th>
                                <th>{{ __('labels.backend.users.fields.email') }}</th>
                                <th>{{ __('labels.backend.users.fields.status') }}</th>
                                <th>{{ __('labels.backend.users.fields.roles') }}</th>
                                <!-- <th>{{ __('labels.backend.users.fields.permissions') }}</th>
                                    <th>{{ __('labels.backend.users.fields.social') }}</th> -->
                                    
                                    <th class="text-right">{{ __('labels.backend.action') }}</th>
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
    @push('after-styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush
    @push('before-scripts')
    
    @endpush
    @push('after-scripts')
    <script>
        var userList = '{{  route('backend.users.index_data') }}';
    </script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script> 
    <script src="{{ asset('js/user-module.js') }}"></script>
    @endpush
