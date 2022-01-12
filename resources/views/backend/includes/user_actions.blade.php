<div class="text-right">
    <a href="#" data-toggle="modal" data-backdrop="false" data-target="#debit-point" class="btn btn-danger btn-sm mt-1 debit-points" data-id="{{ $data->id }}" data-type="debit" title="Debit"><i class="fas fa-arrow-down"></i></a>
    <a href="#" data-toggle="modal" data-backdrop="false" data-target="#credit-point" class="btn btn-success btn-sm mt-1 credit-points" data-id="{{ $data->id }}" data-type="credit" title="Credit"><i class="fas fa-arrow-up"></i></a>
    <a href="{{route('backend.users.show', $data)}}" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.show')}}"><i class="fas fa-desktop"></i></a>
    <a href="{{route('backend.users.edit', $data)}}" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.edit')}}"><i class="fas fa-wrench"></i></a>
    <a href="{{route('backend.users.changePassword', $data)}}" class="btn btn-info btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.changePassword')}}"><i class="fas fa-key"></i></a>

    @if ($data->status != 2 && $data->id != 1)
    <a href="{{route('backend.users.block', $data)}}" class="btn btn-danger btn-sm mt-1" data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.block')}}" data-confirm="@lang('Are you sure?')"><i class="fas fa-ban"></i></a>
    @endif

    @if ($data->status == 2)
    <a href="{{route('backend.users.unblock', $data)}}" class="btn btn-info btn-sm mt-1" data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.unblock')}}" data-confirm="@lang('Are you sure?')"><i class="fas fa-check"></i></a>
    @endif

    <!-- @if ($data->id != 1)
    <a href="{{route('backend.users.destroy', $data)}}" class="btn btn-danger btn-sm mt-1" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}" data-confirm="@lang('Are you sure?')"><i class="fas fa-trash-alt"></i></a>
    @endif -->
</div>