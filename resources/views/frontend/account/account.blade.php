@extends('layouts.frontend.frontend')
@section('title','Kathit | Account')
@section('content')
  <section>
    <div class="sn-addtocart-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-0 text-center">My Account</h3>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
    </div>
    <div class="account-container p-0 my-5">
      <div class="container">
        <div class="row gx-5">
          <div class="col-12 col-md-4">
              @include('layouts.frontend.profile_menu')
          </div>
          <div class="col-12 col-md-8 mt-4 mt-md-0">
            <h5>Profile</h5>
            <form class="" method="post" action="{{ url('/account') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group my-3">
                <label for="name mb-1">
                  User Name
                  @error('name')
                    <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                  @enderror
                </label>
                <input type="text" name="name" class="mt-1 form-control profile-input" id="name" value="{{old('name',isset($user->name) ? $user->name : '')}}" placeholder="Fill Your Name" required>
              </div>
              <div class="form-group my-3">
                <label for="email">
                  Email
                  @error('email')
                    <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                  @enderror
                </label>
                <input type="text" name="email" class="mt-1 form-control profile-input" id="email" value="{{old('email',isset($user->email) ? $user->email : '')}}" placeholder="Fill Your Email" required>
              </div>
              <div class="form-group my-3">
                <label for="mobile_number">
                  Mobile Number
                  @error('mobile_number')
                    <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                  @enderror
                </label>
                <input type="text" name="mobile_number" class="mt-1 form-control profile-input" id="mobile_number" value="{{old('mobile_number',isset($user->mobile_number) ? $user->mobile_number : '')}}" placeholder="Fill Your Phone Number" required>
              </div>
              <button class="checkout">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    
  </script>
@endpush

@push('styles')
  <style>
  .account-container .highlight, .account-container h5, .account-container h4, .account-container h6 {
    font-weight: 600;
    color: #3d0000;
  }
  .profile-input {
    background: transparent;
    border-radius: 5px;
  }
  .checkout {
    background: #d32f2f;
    border: 1px solid #d32f2f;
    border-radius: 3px;
    color: #fff;
    font-weight: bold;
    padding: 8px;
    margin: 30px 0 0 0;
    display: block;
    text-align: center;
  }
  .checkout:hover {
    background: transparent;
    color: #d32f2f;
    cursor: pointer;
  }
  .title-banner {
    /* height: 80px;*/
    background: #eaca9952; 
  }
  .title-banner .left {
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
  }
  .title-banner .right {

  }
  .title-banner .title {
    margin: 0 18%;
    color: #d32f2f;
  }
  .title-banner .title h3 {
    font-weight: bold;
    margin-bottom: 5px;
  }
  @media screen and (max-width: 600px) {
    .title-banner .title {
      margin: 0 5%;
    }
    .title-banner .left {
      width: 60px;
    }
    .title-banner .right {
      width: 60px;
    }
  }
  </style>
@endpush
