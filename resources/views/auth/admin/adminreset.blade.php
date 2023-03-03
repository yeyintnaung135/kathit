@extends('layouts.app')
@section('title','Kathit | Password Reset')

@section('content')
<div class="me-0 loginregistercontainer p-0">
  <div class="d-none d-md-block">
    <div class="container-fluid row gx-0 gx-md-3">
      <div class="col-12 col-md-6 admin-login-bg">
        <div class="admin-login-logo">
          <img src="{{ url('/images/logos/adminlogin.png') }}" alt="Kathit Login" class="login-photo">
          <h4>WELCOME FROM KATHIT</h4>
        </div>
      </div>
      <div class="col-12 col-md-6 px-4 px-md-5 position-relative">
        <div class="admin-login-form">
          <h3 class="mb-4 py-2 lr-head">Admin <span class="highlight">Password Reset</span></h3>
          <form method="POST" action="{{ url('/password/adminreset')}}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="mb-3">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="name" autofocus placeholder="Email Address">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
              </div>
              <div class="mb-0">
                <button type="submit" class="lr-submit">
                    {{ __('Reset Password') }}
                </button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="d-block d-md-none">
    <div class="container-fluid row gx-0 gx-md-3 adminlogin-mb">
      <img src="{{ url('/images/logos/logo.png') }}" alt="Kathit Login" class="col-12 login-photo-mb">
      <div class="col-12 col-md-6 px-4 px-md-5">
        <h3 class="mb-4 py-2 lr-head">Admin <span class="highlight">Password Reset</span></h3>
        <form method="POST" action="{{ url('/password/adminreset')}}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
              <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="name" autofocus placeholder="Email Address">

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="mb-3">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="mb-3">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
            </div>
            <div class="mb-0">
              <button type="submit" class="lr-submit">
                  {{ __('Reset Password') }}
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>

</div>

@endsection
@push('styles')
  <style>
    .highlight {
      color: #d32f2f;
    }
    .login-photo {
      width: 180px;
    }
    .login-photo-mb {
      width: 200px;
      margin: 30px auto 30px auto;
      display: block;
    }
    .admin-login-bg {
      background: #d32f2f;
      height: 100vh;
      position: relative;
    }
    .admin-login-bg .admin-login-logo {
      position: absolute;
      top: 45%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
    .admin-login-logo img {
      margin: 0 auto;
      display: block;
      margin-bottom: 20px;
    }
    .admin-login-logo h4 {
      text-align: center;
      color: #fff;
      font-weight: 900;
    }
    .admin-login-form {
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      width: 62% !important;
    }
    .adminlogin-mb {
      position: absolute;
      top: 45%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
    .loginregistercontainer {
      /* width: 100%; */
      /* padding: 60px 80px;
      border: 1px solid #3330;
      box-shadow: 0px 0px 7px 1px #d32f2f26;
      border-radius: 5px;
      margin: 0 auto; */
    }
    .loginregistercontainer>div{
      /* width: 100%;
      margin-right: 20%; */
    }
    .lr-sub-head {
      color: #3d0000;
    }
    .lr-head {
      color: #3d0000;
      font-weight: bold;
    }
    .lr-submit {
      width: 100%;
      background: #d32f2f;
      border: 0px;
      color: #fff;
      padding: 10px;
    }
    .lr-submit:hover {
      background: #3d0000;
    }
    .loginregistercontainer #email, .loginregistercontainer #password, 
    .loginregistercontainer #name,
    .loginregistercontainer #password-confirm  {
      background: #f3f3f3;
      border: 1px solid #f3f3f3;
      padding: 10px;
      border-radius: 0;
    }
    .forget-pass {
      color: #d32f2f;
    }
    .forget-pass:hover {
      color: #3d0000;
    }
    .register-link {
      color: #3d0000;
      font-weight: bold;
    }

    @media screen and (max-width: 768px) {
      .loginregistercontainer {
        width: 100%;
        padding: 20px 0;
        border: 0;
        box-shadow: none;
      }
      .loginregistercontainer>div{
        width: 100%;
        margin-right: 0px;
      }
      .login-photo {
        width: 140px;
        margin-bottom: 40px;
      }
    }
    @media screen and (min-width: 768px) and (max-width: 1053px){
      .loginregistercontainer {
        width: 100%;
      }
    }
  </style>
@endpush