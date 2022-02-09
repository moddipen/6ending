@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ $module_title }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">{{ __($module_action) }}</small>
                </h4>
                <div class="small text-muted">
                    @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
                </div>
            </div>
            <!--/.col-->
            <div class="co
            l-4">
                <div class="float-right">
                    <div class="btn-group" role="group" aria-label="Toolbar button groups">

                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <form method="post" action="{{ route('backend.settings.store') }}" class="form-horizontal" role="form">
                    {!! csrf_field() !!}

                    @if(count(config('setting_fields', [])) )

                        @foreach(config('setting_fields') as $section => $fields)
                        <div class="card card-accent-primary">
                            <div class="card-header">
                                <i class="{{ Arr::get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                                {{ $fields['title'] }}
                            </div>
                            <div class="card-body">
                                <p class="text-muted">{{ $fields['desc'] }}</p>

                                <div class="row">
                                    <div class="col">
                                        @foreach($fields['elements'] as $field)
                                            @includeIf('backend.settings.fields.' . $field['type'] )
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach

                    @endif

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <button class="btn-primary btn">
                                <i class='fas fa-save'></i> @lang('Save')
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <form method="post" action="{{ route('backend.credits.store') }}" class="form-horizontal" role="form">
                    {!! csrf_field() !!}

                   
                    <div class="card card-accent-primary">
                            <div class="card-header">
                                <i class="fas fa-envelope"></i>
                                Credit Coins
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group ">
                                            <label for="points"> <strong>Coins</strong></label> <span class="text-danger"> <strong>*</strong> </span>
                                            <input type="text" name="points" value="" class="form-control" id="points" placeholder="Coins" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <button class="btn-primary btn">
                                <i class='fas fa-save'></i> @lang('Save')
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- Start form for set coins limit for bett -->
         
        <div class="row mt-4">
            <div class="col">
            <form method="post" action="{{ route('backend.betcoins.store') }}" class="form-horizontal" role="form">
                    {!! csrf_field() !!}
                   
                    <div class="card card-accent-primary">
                            <div class="card-header">
                                <i class="fas fa-coins"></i>
                                Bet Limit
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group ">
                                            <label for="minlimit"> <strong>Minimum Bet Limit</strong></label> <span class="text-danger"><strong>*</strong></span>
                                            <input type="text" name="minlimit" value="" class="form-control" id="minlimit" placeholder="Minimum Bet Limit" required=""><br>

                                            <label for="maxlimit"> <strong>Maximum Bet Limit</strong> </label> <span class="text-danger"><strong>*</strong></span>
                                            <input type="text" name="maxlimit" value="" class="form-control" id="maxlimit" placeholder="maximum Bet Limit" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <button class="btn-primary btn">
                                <i class='fas fa-save'></i> @lang('Save')
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
        <!-- End form for set coins limit for bett -->
    </div>
    <div class="card-footer">
        <div class="row">

        </div>
    </div>
</div>
@endsection
