<x-app-dashboard title="{{ __('User Positions Management') }}">
    @section('links')
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}>
    @endsection

    <x-slot name="header"></x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('User Attendance') }}</li>
        </ol>
    </x-slot>

    <!-- Main row -->
    <div class="row animate__animated animate__slideInUp">     
        <!-- Left col -->
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <form method="post">
                    @method('delete')
                    @csrf
                    <div class="card-header">
                        <h3 class="m-0 font-weight-bold" style="font-family: 'Nunito';">{{ __('User Attendance List') }}</h3>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absences as $absence)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="fw-500">
                                        @if(Str::length($absence->user->name) > 20)
                                            {{ substr( $absence->user->name, 0, 20) }} ...
                                        @else
                                            {{ $absence->user->name }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $absence->user->position->name }}
                                    </td>
                                    <td>
                                        @if(intval($absence->temperature) >= 46 && intval($absence->temperature) >= 46)
                                        <span class="p-2 bg-light rounded border shadow"><i class="fas fa-times-circle text-danger text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $absence->temperature }}°</span> Sangat Panas </span>
                                        @elseif(intval($absence->temperature) >= 38) 
                                        <span class="p-2 bg-light rounded border shadow"><i class="fas fa-times-circle text-warning text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $absence->temperature }}°</span> Panas </span>
                                        @elseif(intval($absence->temperature) <= 34 && intval($absence->temperature) >= 25 ) 
                                        <span class="p-2 bg-light rounded border shadow"><i class="fas fa-check-circle text-success text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $absence->temperature }}°</span> Normal </span>
                                        @elseif(intval($absence->temperature) < 25) 
                                        <span class="p-2 bg-light rounded border shadow"><i class="fas fa-info-circle text-info text-lg shadow rounded-circle"></i> Suhu <span class="text-bold p-1">{{ $absence->temperature }}°</span> Dingin </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $absence->presence_date }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

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

    <!-- Customs for pages -->
    <script>
            $("#tempt").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "{{ __('All') }}"] ],
             "order": [],
             "columnDefs": [{
                 "targets": [],
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
            "buttons": [{
                    "extend": 'copy',
                    "title": "{{ __('User Attendance List') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3, 4]
                    }
                },
                {
                    "extend": 'print',
                    "title": "{{ __('User Attendance List') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3, 4]
                    }
                },
                "colvis"
            ]
        }).buttons().container().appendTo('#tempt_wrapper .col-md-6:eq(0)');
    </script>
    @endsection
</x-app-dashboard>