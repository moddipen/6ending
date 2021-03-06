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
                    <i class="{{$module_icon}}"></i> Events
                    <small class="text-muted">Create </small>
                </h4>
                <div class="small text-muted">
                    Event Managment
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

                {{ html()->form('POST', route('backend.eventmanagers.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="form-group row">
                    {{ html()->label('Match Type')->class('col-sm-2 form-control-label')->for('match_type') }}
                    <div class="col-sm-10">
                        <select class="form-control m-bot15" name="matchtype_id" id="matchtype_id">
                            @if($get_match_types->count() > 0)
                                <option value="">Select Record</option>
                                @foreach ($get_match_types as $key=>$value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>                       
                    </div>                    
                </div>

                <div class="form-group row">
                    {{ html()->label('Event')->class('col-sm-2 form-control-label')->for('event') }}
                    <div class="col-sm-10">
                        <select class="form-control m-bot15" name="eventtype_id" id="eventtype_id">
                           
                        </select>                       
                    </div>                    
                </div>                

                <div class="form-group row">
                    {{ html()->label('Bet Coin')->class('col-sm-2 form-control-label')->for('bet_coin') }}
                    <div class="col-sm-10">
                        <input type="text" name="bet_coin" id="input-bet-coin" class="form-control{{ $errors->has('bet_coin') ? ' is-invalid' : '' }}" placeholder="{{ __('Bet Coin') }}"
                                     value="{{ old('bet_coin', 100) }}" autofocus readonly>
                    </div>                   
                </div>

                <div class="form-group row">
                    {{ html()->label('Win Coin')->class('col-sm-2 form-control-label')->for('win_coin') }}
                    <div class="col-sm-10">
                        <input type="text" name="win_coin" id="input-win-coin" class="form-control{{ $errors->has('win_coin') ? ' is-invalid' : '' }}" placeholder="{{ __('Win Coin') }}"
                        value="{{ old('win_coin') }}" autofocus>
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
<script>
    var get_event_type_ajax = '{{  route('backend.eventtypes.get_event_types_ajax') }}';  
</script>
<script src="{{ asset('/js/event-management.js') }}"></script>
@endpush