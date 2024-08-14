<div {{ $attributes }}>
    @if ($label != '')
        <label class="fs-6 fw-semibold form-label mb-2">
            <span class="{{$attributes->has('required') ? 'required' : ''}}" >
                {{$label}}
            </span>
        </label>
    @endif
    <select class="form-select form-select-solid form-select-lg fw-bold"
        name="{{$name}}"
        data-control="select2"
        data-placeholder="{{ $attributes->has('data-placeholder') ? $attributes['data-placeholder'] : 'Pilih Satu...'}}"
        {{$attributes->has('disabled') ? 'disabled' : ''}}
        {{$attributes->has('readonly') ? 'readonly' : ''}}
        {{ $attributes }}
        value="{{$value}}">
       {{$slot}}
    </select>
</div>
