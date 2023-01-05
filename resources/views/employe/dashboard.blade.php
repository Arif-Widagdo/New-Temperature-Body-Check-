<x-app-dashboard title="{{ __('Dashboard') }}">
    @section('links')
    <!-- Ion Slider --> 
    <link rel="stylesheet" href="{{ asset('plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}>
    @endsection


    {{-- @if($attendances->count() == 0) --}}
    @if($attendances->count() == 0 || $status == 'notaxists')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('employe.store.temperature') }}" id="form_store_temperature" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row d-flex flex-column border-bottom mb-2">
                            <h5 class="text-bold text-white">{{ __('Enter Your Body Temperature and Photo Proof of the Check') }}</h5>
                            <small class="mb-1">
                                <i class="fas fa-info-circle text-black"></i> 
                                <span class="text-danger">{{ __('Fields marked') }} <span class="text-danger">*</span> {{ __('are required') }} </span>
                            </small>
                            </div>
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
                                            <input type="file" class="custom-file-input error_input_image" accept="image/png, image/gif, image/jpeg" id="image" name="image" onchange="previewImage()">
                                            <label class="custom-file-label" for="image">{{ __('Choose File') }}</label>
                                        </div>
                                        <span class="text-danger error-text image_error"></span>
                                        <br>
                                        <small class="mt-1 text-dark font-weight-lighter">
                                            {{ __('Recomen Image Photo') }}
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
            <div class="card">
                <div class="card-header">
                    <h4 class="text-bold">{{ __('List of your Body Temperature Absence History') }}</h4>
                </div>
                <div class="card-body">
                    <table id="tempt" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>{{ __('User Names') }}</th>
                                <th>{{ __('User Positions') }}</th>
                                <th>{{ __('Body temperature') }}</th>
                                <th>{{ __('Attendance Date') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as  $attendance)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="fw-500">
                                    @if(Str::length($attendance->user->name) > 20)
                                        {{ substr( $attendance->user->name, 0, 20) }} ...
                                    @else
                                        {{ $attendance->user->name }}
                                    @endif
                                </td>
                                <td>
                                    {{ $attendance->user->position->name }}
                                </td>
                                <td>
                                    {{-- @if(intval($attendance->temperature) >= 46 && intval($attendance->temperature) >= 46)
                                    Suhu {{ $attendance->temperature }}° (Sangat Panas) 
                                    @elseif(intval($attendance->temperature) >= 38) 
                                    Suhu {{ $attendance->temperature }}° (Panas)
                                    @elseif(intval($attendance->temperature) <= 34 && intval($attendance->temperature) >= 25 ) 
                                    Suhu {{ $attendance->temperature }}° (Normal)
                                    @elseif(intval($attendance->temperature) < 25) 
                                    Suhu {{ $attendance->temperature }}° (Dingin )
                                    @endif --}}
                                    Suhu {{ $attendance->temperature }}° 
                                </td>
                                <td>
                                    {{ $attendance->presence_date }}
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center text-center">
                                        <a data-toggle="modal" data-target="#modal-show{{ $attendance->id }}" class="btn btn-sm btn-info ml-1 d-inline-flex align-items-center font-small">
                                            {{ __('Show') }} <i class="fas fa-eye ml-2"></i>
                                        </a>
                                        @if($attendance->presence_date == $time )
                                        <a data-toggle="modal" data-target="#modal-edit{{ $attendance->id }}" class="btn btn-sm btn-warning ml-1 d-inline-flex align-items-center font-small">
                                            {{ __('Edit') }} <i class="fas fa-edit ml-2"></i>
                                        </a>
                                        <form method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button formaction="{{ route('employe.destroy.temperature', $attendance->id) }}" class="btn btn-sm btn-danger ml-1 d-inline-flex align-items-center font-small" onclick="return confirm('{{ __('Are you sure?') }}')">
                                                {{ __('Remove') }} <i class="fas fa-solid fa-trash-alt ml-2"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body text-center">
                    <h4><i class="fas fa-info-circle"></i> {{ __('You havent done any English attendance at all') }}</h4>
                </div>
            </div>
            @endif
        </div>
    </div>

    @foreach ($attendances as $attendance_show)
    <div class="modal fade" id="modal-show{{ $attendance_show->id }}">
        <div class="modal-dialog modal-md" >
            <div class="modal-content rounded-3">
                <div class="modal-header" >
                    <h3 class="modal-title">
                         {{ $attendance_show->presence_date }}
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <div class="modal-body ">
                    <div class="card-body box-profile">
                        <img src="{{ asset('storage/'. $attendance_show->image) }}" 
                        alt="{{ $attendance->presence_date }}" 
                        class="img-fluid mb-3 rounded-lg img-preview img-fluid border w-100" 
                        style="height: 250px; width: 250px; object-fit: cover;">
                    </div>
                </div>
                <div class="modal-footer float-sm-right">
                    <button type="button" class="btn btn-default " data-dismiss="modal">{{ __('CLose') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!--- Modal Edit -->
    @foreach ($attendances as $attendance)
    <div class="modal fade" id="modal-edit{{ $attendance->id }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark" style="border-bottom:1px solid #FFC107 !important;">
                    <h3 class="modal-title">
                        <i class="fas fa-edit"></i> {{ __('Is there something wrong when entering your body temperature?') }}
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
                            <div class="col-lg-8 p-0">
                                <div class="form-group mb-1">
                                    <label for="image" class="col-form-label">{{ __('Is there something wrong when entering your body temperature?') }} <span class="text-danger">*</span></label>
                                    <input id="range_temperature_edit" type="text" name="temperature" value="{{ $attendance->temperature }}">
                                    <span class="text-danger error-text temperature_error text-bold"></span>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="image" class="col-form-label">{{ __('Enter Evidence Of recording your body temperature') }} <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="hidden" name="oldImage" value="{{ $attendance->image }}">
                                        <input type="file" class="custom-file-input error_input_image" accept="image/png, image/gif, image/jpeg" id="image" name="image" onchange="previewImage()">
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
                                <img src="{{ asset('storage/'. $attendance->image) }}" alt="{{ $attendance->presence_date }}" class="img-fluid mb-3 rounded-lg img-preview img-fluid border w-100" style="height: 250px; width: 250px; object-fit: cover;">
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
    @endforeach
    <!-- /.modal -->

    @section('scripts')
    <!-- Ion Slider -->
    <script src="{{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src={{ asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}></script>
    <script src={{ asset("plugins/datatables-responsive/js/dataTables.responsive.min.js") }}></script>
    <script src={{ asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/dataTables.buttons.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}></script>
    <script src={{ asset("plugins/jszip/jszip.min.js") }}></script>
    <script src={{ asset("plugins/pdfmake/pdfmake.min.js") }}></script>
    <script src={{ asset("plugins/pdfmake/vfs_fonts.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.html5.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.print.min.js") }}></script>
    <script src={{ asset("plugins/datatables-buttons/js/buttons.colVis.min.js") }}></script>

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

        $("#tempt").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "{{ __('All') }}"] ],
             "order": [],
             "columnDefs": [{
                 "targets": [5],
                 "orderable": false,
             }],
             "oLanguage": {
                 "sSearch": "{{ __('Quick Search') }}",
                 "sLengthMenu": "{{ __('DataTableLengthMenu') }}", 
                 "sInfo": "{{ __('DataTableInfo') }}",
                 "oPaginate": {
                     "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
                     "sNext": "{{ __('Next') }}", // This is the link to the next page
                 },
                 "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
                 "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
             },
        });
        
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
 