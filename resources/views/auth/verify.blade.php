@extends('layouts.frontend.frontend')
@section('title','Kathit | Verify Email Address')

@section('content')
<div class="container my-3 my-md-5 pb-3">
    <div class="mx-2 px-2 mx-lg-5 px-lg-5">
        <div class="d-flex justify-content-center align-items-center flex-column-reverse flex-md-row loginregistercontainer">
            <div class="">
                <h5 class="lr-sub-head">Welcom From Kathit Fashion</h5>
                <h3 class="mb-4 py-2 lr-head">Verify Your Email Address</h3>

                  @if (session('resent'))
                      <div class="alert alert-success" role="alert">
                          {{ __('A fresh verification link has been sent to your email address.') }}
                      </div>
                  @endif

                  {{ __('Before proceeding, please check your email for a verification link.') }}
                  {{ __('If you did not receive the email') }},
                  <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                      @csrf
                      <button type="submit" class="lr-submit">{{ __('click here to request another') }}</button>.
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
  <style>
    .login-photo {
      width: 180px;
      float: right;
      display: block;
    }
    .loginregistercontainer {
      width: 80%;
      padding: 60px 80px;
      border: 1px solid #3330;
      box-shadow: 0px 0px 7px 1px #d32f2f26;
      border-radius: 5px;
      margin: 0 auto;
    }
    .loginregistercontainer>div{
      width: 100%;
      margin-right: 20%;
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
    .loginregistercontainer #email, .loginregistercontainer #password {
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