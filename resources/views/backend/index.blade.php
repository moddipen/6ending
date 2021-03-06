@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs/>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                @role('super admin')
                    <h4 class="card-title mb-0">Welcome to 6enddigit Super Admin's Dashboard.</h4>
                @endrole
                @role('admin')
                    <h4 class="card-title mb-0">Welcome to 6enddigit Admin's Dashboard.</h4>
                @endrole
                @role('subadmin')
                    <h4 class="card-title mb-0">Welcome to 6enddigit Sub Admin's Dashboard.</h4>
                @endrole
                @role('supermaster')
                    <h4 class="card-title mb-0">Welcome to 6enddigit Super Master's Dashboard.</h4>
                @endrole
                @role('master')
                    <h4 class="card-title mb-0">Welcome to 6enddigit Master's Dashboard.</h4>
                @endrole              
            </div>

            <!-- <div class="col-sm-4 hidden-sm-down">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <button type="button" class="btn btn-info float-right">
                        <i class="c-icon cil-bullhorn"></i>
                    </button>
                </div>
            </div> -->
        </div>
        <hr>

        <!-- Dashboard Content Area -->

        <!-- / Dashboard Content Area -->

    </div>
</div>
<!-- / card -->
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-gradient-info text-white">
            <div class="card-body">
                <div class="text-value-lg">{{ $remaining_coins; }}</div>
                <div>Remainig Coins</div>               
            </div>
        </div>
    </div>

    <!-- betcoins card start -->
    
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-gradient-danger text-white">
            <div class="card-body">
                <div class="text-value-lg">{{ $bet_coins; }}</div>
                <div>Downline Coins</div>                
            </div>
        </div>
    </div>
    <!-- betcoins card end -->

    <!-- totalcoins card start -->
    
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-gradient-success text-white">
            <div class="card-body">
                <div class="text-value-lg">{{ $total_coins; }}</div>
                <div>Total Coins</div>                
            </div>
        </div>
    </div>    <!-- totalcoins card end -->


</div>
@endsection
