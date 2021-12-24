@extends ('backend.layouts.app')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}' >
        {{ $module_title }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">{{ $module_action }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> User
                    <small class="text-muted">{{ __('labels.backend.users.show.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.users.index.sub-title') }}
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="float-right">
                    <a href="{{ route("backend.users.index") }}" class="btn btn-primary mt-1 btn-sm" data-toggle="tooltip" title="List"><i class="fas fa-list"></i> List</a>

                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <!-- <tr>
                            <th>{{ __('labels.backend.users.fields.avatar') }}</th>
                            <td><img src="{{asset($$module_name_singular->avatar)}}" class="user-profile-image img-fluid img-thumbnail" style="max-height:200px; max-width:200px;" /></td>
                        </tr>
                    -->
                    <tr>
                        <th>{{ __('labels.backend.users.fields.first_name') }}</th>
                        <td>{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('labels.backend.users.fields.last_name') }}</th>
                        <td>{{ $user->last_name }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('labels.backend.users.fields.email') }}</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('labels.backend.users.fields.mobile') }}</th>
                        <td>{{ $user->mobile }}</td>
                    </tr>
                    <tr>
                    </tr>

                    <tr>
                        <th>{{ __('labels.backend.users.fields.status') }}</th>
                        <td>{!! $user->status_label !!}</td>
                    </tr>

                    <tr>
                        <th>{{ __('labels.backend.users.fields.confirmed') }}</th>
                        <td>
                            {!! $user->confirmed_label !!}
                            @if ($user->email_verified_at == null)
                            <a href="{{route('backend.users.emailConfirmationResend', $user->id)}}" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" title="Send Confirmation Email"><i class="fas fa-envelope"></i> Send Confirmation Reminder</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('labels.backend.users.fields.roles') }}</th>
                        <td>
                            @if($user->getRoleNames()->count() > 0)
                            <ul>
                                @foreach ($user->getRoleNames() as $role)
                                <li>{{ ucwords($role) }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th>{{ __('labels.backend.users.fields.created_at') }}</th>
                        <td>{{ $user->created_at }}<br><small>({{ $user->created_at->diffForHumans() }})</small></td>
                    </tr>

                    <tr>
                        <th>{{ __('labels.backend.users.fields.updated_at') }}</th>
                        <td>{{ $user->updated_at }}<br/><small>({{ $user->updated_at->diffForHumans() }})</small></td>
                    </tr>

                </table>
            </div><!--/table-responsive-->

            <hr>
        </div><!--/col-->
    </div>
    <!--/.row-->
</div>
</div>
@endsection
