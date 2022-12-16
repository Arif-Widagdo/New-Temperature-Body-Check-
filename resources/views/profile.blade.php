<x-app-dashboard title="{{ __('Profile') }}">
    @section('links')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Ijabo Crop Tool -->
    <link rel="stylesheet" href="{{ asset('plugins/ijabo-crop-tool/ijaboCropTool.min.css') }}">
    @endsection

    <x-slot name="header">
        {{ __('Profile') }}
    </x-slot>

    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Profile') }}</li>
        </ol>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-body ">
                    <div class="row p-0">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body box-profile">
                                    <div class="text-center position-relative">
                                        <img class="profile-user-img img-fluid img-circle user_picture" src="{{ Auth::user()->picture }}" alt="User profile picture">
                                        @if(Auth::user()->picture != Url('dist/img/users/no-image.jpeg'))
                                        <div class="btn-group" style="position: absolute !important; right:0 !important; top:0;">
                                            <form action="{{ route('profile.deletePicture') }}" method="post"
                                                    class="d-inline" id="deleted-picture">
                                                    @csrf
                                                    <button class="btn btn-danger btn-block" onclick="return confirm('{{ __('Are you sure?') }}')">
                                                        <i class="fas fa-solid fa-trash-alt"></i>
                                                    </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                    <h3 class="profile-username text-center user_name">{{ Auth::user()->name }}</h3>
                                    <p class="text-muted text-center">
                                        {{ Auth::user()->position->name }}
                                    </p>
                                    <input type="file" name="user_image" id="user_image"
                                    accept="image/png, image/gif, image/jpeg"
                                    style="opacity:0;height:1px;display:none">
                                    <a href="javascript:void(0)" id="change_picture_btn" class="btn btn-info btn-block" href="#"><i class="fas fa-user-edit mr-1"></i><span>{{ __('Change Picture') }}</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('Personal Information') }}
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-unbordered " style="list-style-type: none;">
                                        <li class="d-flex align-items-center ">
                                            <p class="col-4">{{ __('Name') }}</p>
                                            <p class="col-8 text-bold border-left"> {{ Auth::user()->name }}</p>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <p class="col-4 ">{{ __('Email') }}</p>
                                            <p class="col-8 text-bold border-left"> {{ Auth::user()->email }}</p>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <p class="col-4 ">{{ __('Gender') }}</p>
                                            <p class="col-8 text-bold border-left">
                                                @if(Auth::user()->gender == 'M')
                                                {{ __('Male') }}
                                                @else
                                                {{ __('Female') }}
                                                @endif
                                            </p>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <p class="col-4 ">{{ __('Number Phone') }}</p>
                                            <p class="col-8 text-bold border-left"> {{ Auth::user()->telp }}</p>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <p class="col-4 ">{{ __('Address') }}</p>
                                            <p class="col-8 text-bold border-left"> {{ Auth::user()->address }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#personal_information" data-toggle="tab" title="{{ __('Personal Information') }}"  data-placement="right">{{ __('Personal Information') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab" title="{{ __('Change Password') }}"  data-placement="right">{{ __('Change Password') }}</a></li>
                    </ul>
                </div>
                <div class="card-body ">
                    <div class="tab-content">
                        <div class="active tab-pane" id="personal_information">
                            <form class="form-horizontal" id="fromInfo" method="POST"
                                action="{{ route('profile.update') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName"
                                        class="col-sm-3 col-form-label ">{{ __('Name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control error_input_name" id="inputName"
                                            placeholder="{{ __('Enter') }} {{ __('Name') }}"
                                            value="{{ Auth::user()->name }}" name="name">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail"
                                        class="col-sm-3 col-form-label">{{ __('Email') }} <span
                                            class="text-danger">*</span></label></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="inputEmail"
                                            disabled
                                            placeholder="{{ __('Enter') }} {{ __('Email') }}"
                                            value="{{ Auth::user()->email }}" name="email">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="InputNoHp"
                                        class="col-sm-3 col-form-label">{{ __('Number Phone') }} <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input class="form-control square error_input_telp"
                                                name="telp" type="number" min="0"
                                                placeholder="{{ __('Enter') }} {{ __('Number Phone') }}"
                                                value="{{ Auth::user()->telp }}">
                                        </div>
                                        <span class="text-danger error-text telp_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputGender"
                                        class="col-sm-3 col-form-label">{{ __('Gender') }} <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control error_input_gender"
                                        style="width: 100%;" name="gender" id="gender">
                                        @if(Auth::user()->gender === 'M')
                                        <option value="M" selected="selected">{{ __('Male') }}</option>
                                        <option value="F">{{ __('Female') }}</option>
                                        @elseif(Auth::user()->gender === 'F')
                                        <option value="M" >{{ __('Male') }}</option>
                                        <option value="F" selected="selected">{{ __('Female') }}</option>
                                        @else
                                        <option selected="selected" disabled>{{ __('Choose Your Gender') }}</option>
                                        <option value="M" >{{ __('Male') }}</option>
                                        <option value="F" >{{ __('Female') }}</option>
                                        @endif
                                        </select>
                                        <span class="text-danger error-text gender_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="InputAddress"
                                        class="col-sm-3 col-form-label">{{ __('Address') }}</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control error_input_address" id="InputAddress"
                                            name="address" cols="30" rows="2"
                                            placeholder="{{ __('Enter') }} {{ __('Address') }}">{{ Auth::user()->address }}</textarea>
                                        <span
                                            class="text-danger error-text address_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit"
                                            class="btn btn-danger float-sm-right mt-4">{{ __('Save Changes') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="change_password">
                            <form class="form-horizontal" method="POST"
                                action="{{ route('profile.changePassword') }}" id="changePasswordForm">
                                <div class="form-group row">
                                    <label for="inputName"
                                        class="col-sm-4 col-form-label">{{ __('Old Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control error_input_oldpassword"
                                            id="inputName"
                                            placeholder="{{ __('Enter') }} {{ __('Old Password') }}"
                                            name="oldpassword">
                                        <span
                                            class="text-danger error-text oldpassword_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName3"
                                        class="col-sm-4 col-form-label">{{ __('New Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control error_input_newpassword"
                                            id="inputName3"
                                            placeholder="{{ __('Enter') }} {{ __('New Password') }}"
                                            name="newpassword">
                                        <span
                                            class="text-danger error-text newpassword_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail"
                                        class="col-sm-4 col-form-label">{{ __('Confirm New Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control error_input_cnewpassword"
                                            id="inputEmail"
                                            placeholder="{{ __('Enter') }} {{ __('Confirm New Password') }}"
                                            name="cnewpassword">
                                        <span
                                            class="text-danger error-text cnewpassword_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-4 col-sm-8">
                                        <button type="submit"
                                            class="btn btn-danger float-sm-right mt-4">{{ __('Update Password') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                            <!-- /.tab-content -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

        @section('scripts')
        <!-- Select 2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- Ijabo Crop Tool -->
        <script src="{{ asset('plugins/ijabo-crop-tool/ijaboCropTool.min.js') }}"></script>

        <script>
                $('.select2').select2()

                $('#fromInfo').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        withCSRF: ['_token', '{{ csrf_token() }}'],
                        beforeSend: function () {
                            $(document).find('span.error-text').text('');
                        },
                        success: function (data) {
                            if (data.status == 0) {
                                $.each(data.error, function (prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                    $('input.error_input_' + prefix).addClass('is-invalid');
                                    $('textarea.error_input_' + prefix).addClass('is-invalid');
                                    $('select.error_input_' + prefix).addClass('is-invalid');
                                });
                                alertToastInfo(data.msg)
                            } else {
                                $('.name_user').each(function () {
                                    $(this).html($('#fromInfo').find($('input[name="name"]')).val());
                                });
                                alertToastSuccess(data.msg)
                            }
                        },
                        error: function (xhr) {
                            Swal.fire(
                                xhr.statusText,
                                '{{ __('Wait a few minutes to try again') }}',
                                'error'
                            )
                        }
                    });
                });

                $('#changePasswordForm').on('submit', function (e) {
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
                                });
                                alertToastInfo(data.msg)
                            } else {
                                $('#changePasswordForm')[0].reset();
                                $('input.error_input_oldpassword').removeClass('is-invalid');
                                $('input.error_input_newpassword').removeClass('is-invalid');
                                $('input.error_input_cnewpassword').removeClass('is-invalid');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function (xhr) {
                            Swal.fire(
                                xhr.statusText,
                                '{{ __('Wait a few minutes to try again') }}',
                                'error'
                            )
                        }
                    });
                });

                $(document).on('click', '#change_picture_btn', function () {
                    $('#user_image').click();
                });

                $('#user_image').ijaboCropTool({
                    preview: '.user_picture',
                    setRatio: 1,
                    allowedExtensions: ['jpg', 'jpeg', 'png'],
                    buttonsText: ['{{ __("Crop") }}', '{{ __("Cancel") }}'],
                    buttonsColor: ['#28A745', '#DC3545', -15],
                    processUrl: '{{ route("profile.pictureUpdate") }}',
                    // withCSRF:['_token','{{ csrf_token() }}'],
                    onSuccess: function (message, element, status) {
                        $('#successToast').addClass("successToast");
                        return $('.successToast').each(function () {
                            Toast.fire({
                                icon: 'success',
                                title: message
                            })
                            setTimeout(function () {
                                location.reload(true);
                            }, 1000);
                        });
                    },
                    onError: function (message, element, status) {
                        $('#errorToast').addClass("errorToast");
                        return $('.errorToast').each(function () {
                            Toast.fire({
                                icon: 'error',
                                title: message
                            })
                        });
                    }
                });

                

        </script>

        @endsection

</x-app-dashboard>
