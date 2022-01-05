@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ $module_title }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> Matches
                    <small class="text-muted">Create </small>
                </h4>
                <div class="small text-muted">
                    Match Create
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <x-buttons.return-back />
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">

                {{ html()->form('POST', route('backend.matches.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="form-group row">
                    {{ html()->label('Match Type')->class('col-sm-2 form-control-label')->for('match_type') }}
                    <div class="col-sm-10">
                        <select class="form-control m-bot15" name="matchtype_id" id="matchtype_id">
                            @if($match_types->count() > 0)
                                <option value="">Select Record</option>
                                @foreach ($match_types as $key=>$value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>                       
                    </div>                    
                </div>
                
                <div class="form-group row">
                    {{ html()->label('Team 1')->class('col-sm-2 form-control-label')->for('team_1') }}
                    <div class="col-sm-10">
                        <input type="text" name="team_1" id="input-win-coin" class="form-control{{ $errors->has('team_1') ? ' is-invalid' : '' }}" placeholder="{{ __('Team 1') }}"
                        value="{{ old('team_1') }}" autofocus>
                    </div>                    
                </div>

                <div class="form-group row">
                    {{ html()->label('Team 2')->class('col-sm-2 form-control-label')->for('team_2') }}
                    <div class="col-sm-10">
                        <input type="text" name="team_2" id="input-win-coin" class="form-control{{ $errors->has('team_2') ? ' is-invalid' : '' }}" placeholder="{{ __('Team 2') }}"
                        value="{{ old('team_2') }}" autofocus>
                    </div>                    
                </div>

                <div class="form-group row">
                    {{ html()->label('Status')->class('col-sm-2 form-control-label')->for('status') }}
                    <div class="col-sm-10">
                        <select class="form-control m-bot15" name="status" id="status">
                            <option value="">Status</option>
                            <option value="0">Active</option>                            
                            <option value="0">In Active</option>                            
                        </select>                       
                    </div>                    
                </div>

                <!--form-group-->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <x-buttons.create title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}">
                                {{__('Create')}}
                            </x-buttons.create>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <div class="form-group">
                                <x-buttons.cancel />
                            </div>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}

            </div>
        </div>

    </div>

</div>
@endsection
@push('after-scripts')
{{-- <script>
    var get_event_type_ajax = '{{  route('backend.eventtypes.get_event_types_ajax') }}';  
</script>
<script src="{{ asset('/js/event-management.js') }}"></script> --}}
@endpush