<x-app-dashboard title="{{ __('Dashboard') }}">
    @section('links')
    <!-- Ion Slider --> 
    <link rel="stylesheet" href="{{ asset('plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    @endsection


    {{-- @if($attendances->count() == 0) --}}
    @if($attendances->count() == 0 || $status == 'notaxists')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('employe.store.temperature') }}" id="form_store_temperature" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h5 class="text-bold">{{ __('Enter Your Body Temperature and Photo Proof of the Check') }}</h5>
                            <small class="mb-4">
                                <i class="fas fa-info-circle text-black"></i> 
                                <span class="text-danger text-bold">{{ __('Fields marked') }} <span class="text-danger">*</span> {{ __('are required') }} </span>
                            </small>
                            <div class="row margin">
                                <div class="col-lg-8 p-0">
                                    <div class="form-group mb-1">
                                        <label for="image" class="col-form-label">{{ __('Enter Your Body Temperature') }} <span class="text-danger">*</span></label>
                                        <input id="range_temperature" type="text" name="temperature" value="">
                                        <span class="text-danger error-text temperature_error text-bold"></span>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="image" class="col-form-label">{{ __('Enter Evidence Of recording your body temperature') }} <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input error_input_image"
                                                accept="image/png, image/gif, image/jpeg" id="image" name="image"
                                                onchange="previewImage()">
                                            <label class="custom-file-label" for="image">{{ __('Choose File') }}</label>
                                        </div>
                                        <span class="text-danger error-text image_error"></span>
                                        <br>
                                        <small class="mt-1 text-dark font-weight-lighter">
                                            {{ __('Recomen Image Product') }}
                                            <span class="text-bold">600x600 </span>| {{ __('File Size') }} 
                                            <span class="text-bold"> 1024 kb</span>
                                            {{ __('or') }} <span class="text-bold"> 1 MB</span>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <img src="" alt="" class="img-fluid mb-3 rounded-lg img-preview img-fluid border w-100" style="height: 250px; width: 250px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info float-sm-right">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    {{-- @endif --}}

    <div class="row">
        <div class="col-md-12">
            @if($attendances->count() > 0)
            <div class="row ">
                <h4>{{ __('List of your Body Temperature Absence History') }}</h4>
                @foreach ($attendances as  $attendance)
                <div class="col-lg-12">
                    <div class="timeline">
                        <div class="time-label">
                            @if(intval($attendance->temperature) >= 46 && intval($attendance->temperature) >= 46)
                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-clock text-danger text-lg shadow rounded-circle"></i> {{ $attendance->presence_date }}</span>
                            @elseif(intval($attendance->temperature) >= 38) 
                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-clock text-warning text-lg shadow rounded-circle"></i> {{ $attendance->presence_date }}</span>
                            @elseif(intval($attendance->temperature) <= 34 && intval($attendance->temperature) >= 25 ) 
                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-clock text-success text-lg shadow rounded-circle"></i> {{ $attendance->presence_date }}</span>
                            @elseif(intval($attendance->temperature) < 25) 
                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-clock text-info text-lg shadow rounded-circle"></i> {{ $attendance->presence_date }}</span>
                            @endif
                        </div>
                        <div>
                            @if(intval($attendance->temperature) >= 46 && intval($attendance->temperature) >= 46)
                                <i class="fas fa-temperature-low text-danger text-lg rounded border shadow rounded-circle " style="background-color: #454D55!important;"></i>
                            @elseif(intval($attendance->temperature) >= 38) 
                               <i class="fas fa-temperature-low text-warning text-lg rounded border shadow rounded-circle" style="background-color: #454D55!important;"></i>
                            @elseif(intval($attendance->temperature) <= 34 && intval($attendance->temperature) >= 25 ) 
                               <i class="fas fa-temperature-low text-success text-lg rounded border shadow rounded-circle" style="background-color: #454D55!important;"></i>
                            @elseif(intval($attendance->temperature) < 25) 
                               <i class="fas fa-temperature-low text-info text-lg rounded border shadow rounded-circle" style="background-color: #454D55!important;"></i>
                            @endif
                            <div class="timeline-item overflow-hidden">
                                <div class="timeline-body text-center border rounded">
                                    <div class="row">
                                        <div class="col-lg-5 mb-1">
                                            @if(intval($attendance->temperature) >= 46 && intval($attendance->temperature) >= 46)
                                            <h1 class="bg-danger rounded-circle d-inline-block p-4">
                                                {{ $attendance->temperature }}°
                                            </h1>
                                            @elseif(intval($attendance->temperature) >= 38) 
                                            <h1 class="bg-warning rounded-circle d-inline-block p-4">
                                                {{ $attendance->temperature }}°
                                            </h1>
                                            @elseif(intval($attendance->temperature) <= 34 && intval($attendance->temperature) >= 25 ) 
                                            <h1 class="bg-success rounded-circle d-inline-block p-4">
                                                {{ $attendance->temperature }}°
                                            </h1>
                                            @elseif(intval($attendance->temperature) < 25) 
                                            <h1 class="bg-info rounded-circle d-inline-block p-4">
                                                {{ $attendance->temperature }}°
                                            </h1>
                                            @endif
                                        </div>
                                        <div class="col-lg-7 d-flex flex-column justify-content-center align-items-center">
                                            <div>
                                                <a class="mb-3 btn btn-dark" target="_blank" href="{{ asset('storage/'. $attendance->image) }}">{{ __('Image') }}</a>
                                                {{-- <img src="{{ asset('storage/'. $attendance->image) }}" alt=""> --}}
                                                <br >
                                                @if(intval($attendance->temperature) >= 40 && intval($attendance->temperature) >= 40)
                                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-times-circle text-danger text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $attendance->temperature }}°</span> Sangat Panas </span>
                                                @elseif(intval($attendance->temperature) >= 38) 
                                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-times-circle text-warning text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $attendance->temperature }}°</span> Panas </span>
                                                @elseif(intval($attendance->temperature) <= 34 && intval($attendance->temperature) >= 25 ) 
                                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-check-circle text-success text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $attendance->temperature }}°</span> Normal </span>
                                                @elseif(intval($attendance->temperature) < 25) 
                                                <span class="p-2 bg-light rounded border shadow"><i class="fas fa-info-circle text-info text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $attendance->temperature }}°</span> Dingin </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($attendance->presence_date == $time )
                                <div class="toggle position-absolute" style="top:0; right:0">
                                    <a class="btn text-dark font-weight-bold" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i></a>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right border" role="menu">
                                        <a data-toggle="modal" data-target="#modal-edit{{ $attendance->id }}"
                                            class="btn px-3 dropdown-item">
                                            <i class="fas fa-edit bg-warning p-2 rounded-pill"></i> {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('employe.destroy.temperature', $attendance->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="dropdown-item" onclick="return confirm('{{ __('Are you sure?') }}')">
                                                <i class="fas fa-trash mr-1 bg-danger p-2 rounded-pill"></i> {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    Anda Belum Sama Sekali Absensi
                </div>
            </div>
            @endif
        </div>
    </div>

    @foreach ($attendances as $attendance)
    <!--- Modal Edit -->
    <div class="modal fade" id="modal-edit{{ $attendance->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark" style="border-bottom:2px solid #FFC107 !important;">
                    <h3 class="modal-title">
                        <span class="badge badge-warning"><i class="fas fa-edit"></i> {{ __('Body Temperature Edit Form') }} </span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#FFC107">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('employe.update.temperature', $attendance->id) }}" id="form_edit_position" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <form class="form-horizontal" method="POST" action="" id="form_store_temperature">
                    @csrf
                    <div class="modal-body">
                        <div class="row margin">
                            <h5 class="mb-4 ml-2">{{ __('Is there something wrong when entering your body temperature?') }}</h5>
                            <div class="col-sm-12">
                                <input id="range_temperature_edit" type="text" name="temperature" value="{{ $attendance->temperature }}">
                                <span class="text-danger error-text temperature_error text-bold"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-warning text-bold">{{ __('Save Change') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    @endforeach

    @section('scripts')
    <!-- Ion Slider -->
    <script src="{{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
        
        $('#range_temperature').ionRangeSlider({
            min: 30,
            max: 46,
            from: 0,
            type: 'single',
            step: 1,
            postfix: '°',
            prettify: false,
            hasGrid: true
        })

        $('#range_temperature_edit').ionRangeSlider({
            min: 30,
            max: 46,
            from: $("#range_6").val(),
            type: 'single',
            step: 1,
            postfix: '°',
            prettify: false,
            hasGrid: true
        })

        $('#form_store_temperature').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('input.error_input_' + prefix).addClass('is-invalid');
                            $('select.error_input_' + prefix).addClass('is-invalid');
                        });
                        alertToastInfo(data.msg)
                    } else {
                        $('#form_store_temperature')[0].reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                        alertToastSuccess(data.msg)
                    }
                },
                error: function (xhr) {
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again') }}', 'error')
                }
            });
        });
    </script>
    @endsection
    
 </x-app-dashboard>
 