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
    <div class="billing-container p-0 my-5">
      <div class="container">
        @php $total = 0 @endphp
        @foreach ( $products as $product )
          @php $total += $product->count * $product->price_per_product @endphp
        @endforeach
        @if (count($products) != 0)
          <form class="row gx-lg-5" method="post" action="{{ url('/storebillingaddress') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-12 col-md-6">
              <div class="">
                <p class="text-danger bold mb-2">* Please check detail for delivery information</p>
                <button type="button" class="size-guide" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Delivery Information Detail
                </button>
              </div>
              <div class="my-4">
                <h5>Billing Detail</h5>
                <div class="form-group my-3">
                  <label for="name">
                    Full Name <span style="color:red;font-size:13px;">*</span>
                    @error('name')
                      <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                    @enderror
                  </label>
                  <input type="text" name="name" class="form-control billing-input" id="name" value="{{old('name',isset($billing->name) ? $billing->name : '')}}" placeholder="Fill Your Name" required>
                </div>
                <div class="form-group my-3">
                  <label for="phone">
                    Phone <span style="color:red;font-size:13px;">*</span>
                    @error('phone')
                      <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                    @enderror
                  </label>
                  <input type="text" name="phone" class="form-control billing-input" id="phone" value="{{old('phone',isset($billing->phone) ? $billing->phone : '')}}" placeholder="Your Phone Number" required>
                </div>
                <div class="form-group my-3">
                  <label for="email">
                    Email <span style="color:red;font-size:13px;">*</span>
                    @error('email')
                      <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                    @enderror
                  </label>
                  <input type="text" name="email" class="form-control billing-input" id="email" value="{{old('email',isset($billing->email) ? $billing->email : '')}}" placeholder="Your Gmail Address" required>
                </div>
                <div class="form-group my-3">
                  <label for="address">
                    Street Address <span style="color:red;font-size:13px;">*</span>
                    @error('address')
                      <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                    @enderror
                  </label>
                  <input type="text" name="address" class="form-control billing-input" id="address" value="{{old('address',isset($billing->address) ? $billing->address : '')}}" placeholder="Fill Your Full Address" required>
                </div>
                <div class="row gx-3 my-3">
                  <div class="form-group col-6">
                    <label for="state">
                      State <span style="color:red;font-size:13px;">*</span>
                      @error('state')
                        <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                      @enderror
                    </label>
                    <input type="text" name="state" class="form-control billing-input" id="state" value="{{old('state',isset($billing->state) ? $billing->state : '')}}" placeholder="State" required>
                  </div>
                  <div class="form-group col-6">
                    <label for="city">
                      City <span style="color:red;font-size:13px;">*</span>
                      @error('city')
                        <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                      @enderror
                    </label>
                    <input type="text" name="city" class="form-control billing-input" id="city" value="{{old('city',isset($billing->city) ? $billing->city : '')}}" placeholder="City" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="bg-pink mt-3 mt-lg-0">
                <h5 class="mb-3">Order Summary</h5>
                @foreach ( $products as $product )
                  <div class="py-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                      <img src="{{url(App\Models\ProductPhoto::where('product_id', $product->product_id)->value('product_image'))}}" alt="" class="product-img me-2 me-lg-3">
                      <p class="mb-0 highlight"><a href="{{ url('/product/detail/'.$product->product_id) }}">{{ $product->name }}</a> {{ $product->readytowear_size ? '( ' . $product->readytowear_size . ' )' : '' }} × {{ $product->count }}</p>
                    </div>
                    <p class="mb-0">{{ $product->count * $product->price_per_product }} MMK</p>
                  </div>
                @endforeach
                <div class="py-4 d-flex justify-content-between border-bottom">
                  <p class="mb-0 highlight">Sub Total</p>
                  <p class="mb-0 highlight">{{ $total }} MMK</p>
                </div>
                <div class="py-4 d-flex justify-content-between order-total">
                  <p class="mb-0 highlight">Total</p>
                  <p class="mb-0 highlight">{{ $total }} MMK</p>
                </div>
                <button class="checkout">Continue to Payment</button>
              </div>
            </div>
          </form>
        @else
          <div class="go-shopping">
            <h3 class="mb-4">There is no items in the cart.</h3>
            <a href="{{ url('/products') }}">Go Shopping</a>
          </div>
        @endif
      </div>
      {{-- pop up --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="{{ url('/images/sizeguide/deli_info.jpg') }}" alt="Kathit" class="w-100">
            </div>
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
    .go-shopping {
      text-align: center;
    }
    .go-shopping a {
      background: #d32f2f;
      border: 1px solid #d32f2f;
      border-radius: 3px;
      color: #fff;
      font-weight: bold;
      padding: 8px;
    }
    .go-shopping a:hover {
      color: #d32f2f;
      background: #fff;;
    }
    .bold {
      font-weight: bold;
    }
    .bg-pink {
      background: #eaca9952;
      padding: 40px;
    }
    .billing-container th, .highlight, .billing-container h5, .billing-container h4 {
      font-weight: bold;
      color: #3d0000;
    }
    .product-img {
      width: 100px;
    }
    .checkout {
      background: #d32f2f;
      border: 1px solid #d32f2f;
      border-radius: 3px;
      color: #fff;
      font-weight: bold;
      padding: 8px;
      width: 100%;
      display: block;
      text-align: center;
    }
    .checkout:hover {
      background: transparent;
      color: #d32f2f;
      cursor: pointer;
    }
    .size-guide {
      background: none;
      border: 0px;
      border-bottom: 1px solid #000 !important;
      padding: 0;
    }
    #exampleModal .modal-dialog {
      max-width: 90% !important;
      margin: 20px auto !important;
    }
    .billing-input {
      background: transparent;
      border-radius: 3px;
    }
    .form-control:focus {
      box-shadow: none;
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
      .bg-pink {
        padding: 20px;
      }
      .product-img {
        width: 70px;
      }
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
