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
                    <input type="text" class="form-control my-2" placeholder=" Search" wire:model="searchTerm" />
        
                    <table class="table table-hover table-responsive-sm" id="user-list">
                        <thead>
                            <tr>
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
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $users->total() !!} {{ __('labels.backend.total') }}
                    </div>
                </div>
                <div class="col-5">
                    <div class="float-right">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
</div>

@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('js/user-module.js') }}"></script>
    
@endpush