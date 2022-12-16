<x-guest-layout title="{{ __('Register') }}">

    <div class="card-header py-2 border-info" >
        <h4 style="font-family: 'Poppins', cursive; font-weight: 700 !important;">{{ __('Register') }}</h4>
        <div class="text-danger text-sm text-bold">
          {{ __('* required fileds') }}
        </div>
      </div>
      <form class="form-horizontal" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="card-body ">
          @if(session()->has('status'))
          <div class="card p-1 text-danger bg-transparent border">
            <span><i class="fas fa-info-circle"></i> <strong>{{ session('status') }}</strong></span> 
          </div>
          @endif
          <div class="form-group mb-1">
            <label for="name" class="col-form-label">{{ __('Name') }} <span class="text-danger text-bold">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="{{ __('Enter Your Full Name') }}" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            @error('name')
            <span class="text-danger error-text">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mb-1">
            <label for="id_position" class="col-form-label">{{ __('User Position') }} <span class="text-danger text-bold">*</span></label>
            <div class="input-group">
                <div class="row m-0 p-0 w-100">
                    <div class="d-flex flex-row w-100">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                        </div>
                        <select class="form-control select2" style="width: 100%" name="id_position">
                            <option selected="selected" disabled>{{ __('Select User Position') }}</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}" {{ old('id_position') ? "selected='selected'" : ''  }}>{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @error('id_position')
            <span class="text-danger error-text">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mb-1">
            <label for="email" class="col-form-label">{{ __('Email') }} <span class="text-danger text-bold">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="{{ __('Enter Your Email') }}" required>
            </div>
            @error('email')
            <span class="text-danger error-text">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mb-1">
            <label for="password" class="col-form-label">{{ __('Password') }} <span class="text-danger text-bold">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="password" required autocomplete="new-password" class="form-control" placeholder="{{ __('Enter Your Password') }}">
            </div>
            @error('password')
            <span class="text-danger error-text">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mb-4">
            <label for="password" class="col-form-label">{{ __('Confirm Password') }} <span class="text-danger text-bold">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Retype Your Password') }}">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between border-info">
            <a href="{{ route('login') }}" class="btn btn-default">{{ __('Login') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
        </div>
      </form>
        
    {{-- <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Register a new membership</p>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" name="name"
                        value="{{ old('name') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('name')
                <span class="text-danger error-text role_error">{{ $message }}</span>
                @enderror
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                <span class="text-danger error-text role_error">{{ $message }}</span>
                @enderror
                <div class="input-group mb-3">
                    <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="id_position" style="width: 100%;">
                        <option selected="selected">Pilih Posisi</option>
                        @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" required autocomplete="new-password" class="form-control"
                        placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <small class="text-danger mb-3">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-0">
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div> --}}


</x-guest-layout>
