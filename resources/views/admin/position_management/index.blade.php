<x-app-dashboard title="{{ __('User Positions Management') }}">
    @section('links')
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}>
    @endsection

    <x-slot name="header">
        {{ __('User Positions Management') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('User Positions Management') }}</li>
        </ol>
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countPosition" class="w-100" value="{{ $positions->count() }}">
        </div>
    </div>

    <!-- Main row -->
    <div class="row animate__animated animate__slideInUp">     
        <!-- Left col -->
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <form method="post">
                    @method('delete')
                    @csrf
                    <div class="card-header">
                        <button formaction="{{ route('admin.position.deleteAll') }}" class="btn btn-danger float-left" type="submit" hidden id="btn-delet-all" onclick="return confirm('{{ __('Are you sure?') }}')">
                            <i class="fas fa-solid fa-trash"></i> {{ __('Delete All Selected') }}
                        </button>
                        <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-create">
                            {{ __('Create New Position') }} <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    @if($positions->count() > 0)
                    <div class="card-body">
                        <table id="table-positions" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="selectall" style="max-width: 15px !important;"></th>
                                    <th>{{ __('Position Names') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $position)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $position->id }}"></td>
                                    <td class="fw-500">
                                        @if(Str::length($position->name) > 20)
                                        {{ substr( $position->name, 0, 20) }} ...
                                        @else
                                        {{ $position->name }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($position->status == 1)
                                        <i class="fas fa-check-circle text-success text-lg shadow rounded-circle" ></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center text-center">
                                            <a class="btn btn-sm btn-info ml-1 d-inline-flex align-items-center font-small" href="{{ route('positions.show', $position->slug) }}">
                                            {{ __('Show') }} <i class="fas fa-eye ml-2"></i>
                                            </a>
                                            @if($position->name != 'Admin')
                                            <a data-toggle="modal" data-target="#modal-edit{{ $position->slug }}"
                                                class="btn btn-sm btn-warning ml-1 d-inline-flex align-items-center font-small">
                                                {{ __('Edit') }} <i class="fas fa-edit ml-2"></i>
                                            </a>
                                            <form method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button
                                                    formaction="{{ route('positions.destroy', $position->slug) }}"
                                                    class="btn btn-sm btn-danger ml-1 d-inline-flex align-items-center font-small"
                                                    onclick="return confirm('{{ __('Are you sure?') }}')">
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
                    @endif
                </form>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!--- Modal Create -->
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">{{ __('New User Position Form') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('positions.store') }}" id="form_create_position" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="border-bottom text-danger border-info text-bold">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="name" class="col-form-label">{{ __('Position Name') }} <span class="text-danger">*</span></label>
                            <input type="text" id="name" class="form-control error_input_name" placeholder="{{ __('Enter') }} {{ __('Position Name') }}" name="name">
                            <span class="text-danger error-text name_error text-bold"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <div class="col-form-label d-flex justify-content-between align-items-center">
                                <label for="slug" class="col-form-label col-2 ">{{ __('Slug') }} <span class="text-danger">*</span></label>
                                <small class="col-10 text-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>

                            <input type="disabled" id="slug" class="form-control error_input_slug" placeholder="{{ __('Automatically') }}" name="slug" disable readonly>
                            <span class="text-danger error-text slug_error text-bold"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="status" class="col-form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                            <select class="form-control error_input_status" style="width: 100%;" name="status">
                                <option selected="selected" disabled>{{ __('Choose Status') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Not Active') }}</option>
                            </select>
                            <span class="text-danger error-text status_error text-bold"></span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-info">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    @foreach ($positions as $position_edit)
    <!--- Modal Edit -->
    <div class="modal fade" id="modal-edit{{ $position_edit->slug }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark" style="border-bottom:2px solid #FFC107 !important;">
                    <h3 class="modal-title">
                        <span class="badge badge-warning"><i class="fas fa-edit"></i> {{ __('Position Edit Form') }} </span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#FFC107">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('positions.update', $position_edit->slug) }}" id="form_edit_position{{ $loop->iteration }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="border-bottom text-danger border-warning text-bold">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="name_edit" class="col-form-label">{{ __('Position Name') }} <span class="text-danger">*</span></label>
                            <input type="text" id="name_edit{{ $loop->iteration }}" class="form-control error_input_name_edit" placeholder="{{ __('Enter') }} {{ __('Position Name') }}" name="name" value="{{ $position_edit->name }}">
                            <span class="text-danger error-text name_edit_error"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <div class="col-form-label d-flex justify-content-between align-items-center">
                                <label for="slug_edit" class="col-form-label col-2 ">{{ __('Slug') }} <span class="text-danger">*</span></label>
                                <small class="col-10 text-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="disabled" id="slug_edit{{ $loop->iteration }}" class="form-control error_input_slug_edit" placeholder="{{ __('Automatically') }}" name="slug" disable readonly value="{{ $position_edit->slug }}">
                            <span class="text-danger error-text slug_edit_error"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="statusEdit" class="col-form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                            <select class="form-control error_input_statusEdit" style="width: 100%;" name="status">
                                {{-- <option selected="selected" disabled>{{ __('Choose Status') }}</option> --}}
                                @if($position_edit->status == 1)
                                <option value="1" selected="selected">{{ __('Active') }}</option> 
                                <option value="0">{{ __('Not Active') }}</option> 
                                @else
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0" selected="selected">{{ __('Not Active') }}</option>
                                @endif
                            </select>
                            <span class="text-danger error-text statusEdit_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-warning">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endforeach

    @section('scripts')
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
    <!-- SweetAlert 2 | Display Message -->
    <script src="{{ asset('dist/js/sweetalert2.all.min.js') }}"></script>
    <!-- Toaster -->
    <script src="{{ asset('dist/js/toastr.min.js') }}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <!-- Customs for pages -->
    <script>
            // -------- Data Table
            $("#table-positions").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "{{ __('All') }}"] ],
                "order": [],
                "columnDefs": [{
                    "targets": [0, 3],
                    "orderable": false,
                }],
                "oLanguage": {
                    "sSearch": "{{ __('Quick Search') }}",
                    "sLengthMenu": "{{ __('DataTableLengthMenu') }}", 
                    "sInfo": "{{ __('DataTableInfo') }}",
                    "oPaginate": {
                        // "sFirst": "First page", // This is the link to the first page
                        "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
                        "sNext": "{{ __('Next') }}", // This is the link to the next page
                        // "sLast": "Last page" // This is the link to the last page
                    },
                    "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
                    "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
                },
            });

            // CheckSlug
            const name = document.querySelector('#name');
            const slug = document.querySelector('#slug');

            name.addEventListener('change', function () {
                fetch('admin/check-positions/slug?name=' + name.value)
                    .then(response => response.json())
                    .then(data => slug.value = data.slug)
            });

            $('#form_create_position').on('submit', function (e) {
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
                            $('#form_create_position')[0].reset();
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

            $('.selectall').click(function () {
                $('.selectbox').prop('checked', $(this).prop('checked'));
                $("#btn-delet-all").prop("hidden", !$(this).prop('checked'));
            });

            $('.selectbox').change(function () {
                var total = $('.selectbox').length;
                var number = $('.selectbox:checked').length;
                if (total == number) {
                    $('.selectall').prop('checked', true);
                } else {
                    $('.selectall').prop('checked', false);
                }
                $("#btn-delet-all").prop("hidden", !$('.selectbox:checked').length);
            });

            // Edit Posiitions
            const countPosition = document.querySelector('#countPosition');

            for (let i = 1; i <= countPosition.value; i++) {
                const name_edit = document.querySelector('#name_edit'+i);
                const slug_edit = document.querySelector('#slug_edit'+i);

                name_edit.addEventListener('change', function () {
                    fetch('admin/check-positions/slug?name=' + name_edit.value)
                        .then(response => response.json())
                        .then(data => slug_edit.value = data.slug)
                });

                $('#form_edit_position'+i).on('submit', function (e) {
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
                                    $('span.' + prefix + '_edit_error').text(val[0]);
                                    $('input.error_input_edit_' + prefix).addClass('is-invalid');
                                });
                                alertToastInfo(data.msg)
                            } else {
                                $('#form_edit_position'+i)[0].reset();
                                setTimeout(function () {
                                    location.reload(true);
                                }, 1000);
                                alertToastSuccess(data.msg)
                            }
                        },
                        error: function (xhr) {
                            Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again ') }}', 'error')
                        }
                    });
                });
            }
            


        
    </script>
    @endsection
</x-app-dashboard>