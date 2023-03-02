@extends('layouts.frontend.frontend')
@section('title','Kathit | Billing Address')
@section('content')
  <section>
    <div class="sn-addtocart-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-0 text-center">Billing Address</h3>
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
            <h5>Billing Address</h5>
            <form class="" method="post" action="{{ url('/account/billing-address') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group my-3">
                <label for="name">
                  Full Name 
                  @error('name')
                    <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                  @enderror
                </label>
                <input type="text" name="name" class="mt-1 form-control profile-input" id="name" value="{{old('name',isset($billing->name) ? $billing->name : '')}}" placeholder="Fill Your Name" required>
              </div>
              <div class="form-group my-3">
                <label for="phone">
                  Phone 
                  @error('phone')
                    <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                  @enderror
                </label>
                <input type="text" name="phone" class="mt-1 form-control profile-input" id="phone" value="{{old('phone',isset($billing->phone) ? $billing->phone : '')}}" placeholder="Your Phone Number" required>
              </div>
              <div class="form-group my-3">
                <label for="email">
                  Email 
                  @error('email')
                    <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                  @enderror
                </label>
                <input type="text" name="email" class="mt-1 form-control profile-input" id="email" value="{{old('email',isset($billing->email) ? $billing->email : '')}}" placeholder="Your Gmail Address" required>
              </div>
              <div class="form-group my-3">
                <label for="address">
                  Street Address 
                  @error('address')
                    <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                  @enderror
                </label>
                <input type="text" name="address" class="mt-1 form-control profile-input" id="address" value="{{old('address',isset($billing->address) ? $billing->address : '')}}" placeholder="Fill Your Full Address" required>
              </div>
              <div class="row gx-3 my-3">
                <div class="form-group col-6">
                  <label for="state">
                    State 
                    @error('state')
                      <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                    @enderror
                  </label>
                  <input type="text" name="state" class="mt-1 form-control profile-input" id="state" value="{{old('state',isset($billing->state) ? $billing->state : '')}}" placeholder="State" required>
                </div>
                <div class="form-group col-6">
                  <label for="city">
                    City 
                    @error('city')
                      <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                    @enderror
                  </label>
                  <input type="text" name="city" class="mt-1 form-control profile-input" id="city" value="{{old('city',isset($billing->city) ? $billing->city : '')}}" placeholder="City" required>
                </div>
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
