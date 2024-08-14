<x-admin.button.icon type="edit" href="{{ route('user.edit', $model) }}" />

@if ($model->id != 1)
    <x-admin.button.icon type="delete" href="{{ route('user.destroy', $model) }}" id="btn-delete" data-id="{{$model->id}}" />
@endif


