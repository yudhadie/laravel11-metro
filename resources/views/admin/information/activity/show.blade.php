@extends('admin.templates.default')

@section('content')

    <x-admin.card.default>
        <x-admin.form.show name='ID' :value='$data->id' />
        <x-admin.form.show name='Data' :value='$data->log_name' />
        <x-admin.form.show name='User' :value="$data->user->name ?? 'deleted'" />
        <x-admin.form.show name='Time:' value="{{Carbon\Carbon::parse($data->created_at)}}" />
        <x-admin.form.show name='Event' :value="$data->event" />

        <div class="row mb-7">
            <label class="col-lg-2 fw-semibold text-muted">Action</label>

            @if (isset($properties->old))
                <div class="col-lg-5">
                    <div class="d-flex flex-column">
                        <h5>OLD</h5>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> ID : {{ $data->subject_id }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Name: {{ $properties->old->name }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Email: {{ $properties->old->email }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Photo: {{ $properties->old->photo }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Active: {{ $properties->old->active == 1 ? 'Yes' : 'Disabled' }}
                        </li>
                    </div>
                </div>
            @endif
            @if (isset($properties->attributes))
                <div class="col-lg-5">
                    <div class="d-flex flex-column">
                        <h5>New</h5>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> ID : {{ $data->subject_id }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Name: {{ $properties->attributes->name }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Email: {{ $properties->attributes->email }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Photo: {{ $properties->attributes->photo }}
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5"></span> Active: {{ $properties->attributes->active == 1 ? 'Yes' : 'Disabled' }}
                        </li>
                    </div>
                </div>
            @endif

        </div>

        <x-admin.card.footer>
            <x-admin.button.back href="{{route('log-activity.index')}}"/>
        </x-admin.card.footer>
    </x-admin.card.default>

@endsection

@push('scripts')
    <x-admin.menu.show menu="menu-info"/>
    <x-admin.menu.active menu="menu-info-activity"/>
@endpush
