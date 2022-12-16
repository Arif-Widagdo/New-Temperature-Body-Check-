<x-app-layout title="Dashboard">
    @section('links')
    <!-- Ion Slider -->
    <link rel="stylesheet" href="{{ asset('plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    @endsection
    <x-slot name="header">
        {{ __('Edit Temperature') }}
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            {{-- <form class="form-horizontal" method="POST" action="{{ route('temperature.update', $temperature) }}" id="form_create_position"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label for="message" class="col-form-label">Temperature<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" name="message" cols="30" rows="5"
                            placeholder="{{ __('Enter') }} Temperature">{{ old('message', $temperature->message) }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary float-sm-right">{{ __('Submit') }}</button>
                </div>
            </form> --}}
            <form class="form-horizontal" method="POST" action="" id="form_create_position"
                enctype="multipart/form-data">
                {{-- <form class="form-horizontal" method="POST" action="{{ route('temperature.update', $temperature) }}" id="form_create_position"
                enctype="multipart/form-data"> --}}
                @csrf
                @method('patch')
                <div class="row margin">
                    <h5 class="mb-3 text-bold">Input Your Temperature</h5>
                    <div class="col-sm-12">
                        <input id="range_6" type="text" name="temperature" value="{{ old('message', $temperature->temperature) }}">
                        @error('temperature')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary float-sm-right">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
    <!-- Ion Slider -->
    <script src="{{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script>
        $('#range_6').ionRangeSlider({
            min: 0,
            max: 50,
            from: $("#range_6").val(),
            type: 'single',
            step: 1,
            postfix: '°',
            prettify: false,
            hasGrid: true
        })
    </script>
    @endsection
</x-app-layout>
