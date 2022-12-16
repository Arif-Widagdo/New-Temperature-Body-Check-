<x-guest-layout title="{{ __('Login') }}">
  <div class="card-header py-2 border-info" >
    <h4 style="font-family: 'Poppins', cursive; font-weight: 700 !important;">{{ __('Login') }}</h4>
    <div class="text-danger text-sm text-bold">
      {{ __('* required fileds') }}
    </div>
  </div>
  <form class="form-horizontal" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="card-body ">
      @if(session()->has('status'))
      <div class="card p-1 text-white bg-transparent border">
        <span><i class="fas fa-info-circle text-info"></i> <strong>{{ session('status') }}</strong></span> 
      </div>
      @endif
      <div class="form-group mb-1">
        <label for="email" class="col-form-label">{{ __('Email') }} <span class="text-danger text-bold">*</span></label>
        <span class="text-danger text-bold error-text email_error"></span>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input type="email" class="form-control" placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        @error('email')
        <span class="text-danger error-text">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group mb-4">
        <label for="password" class="col-form-label">{{ __('Password') }} <span class="text-danger text-bold">*</span></label>
        <span class="text-danger text-bold error-text password_error"></span>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password">
        </div>
        @error('password')
        <span class="text-danger error-text">{{ $message }}</span>
        @enderror
      </div>
      <div class="row d-flex align-items-center">
        <div class="col-6">
          <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                  {{ __('Remember Me') }}
              </label>
          </div>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('password.request') }}" class="text-info">{{ __('Forgot your password?') }}</a>
        </div>
      </div>
    </div>
    <div class="modal-footer justify-content-between border-info">
        <a href="{{ route('register') }}" class="btn btn-default">{{ __('Register') }}</a>
        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
    </div>
  </form>
    

   


</x-guest-layout>
