@extends('layouts.frontend.frontend')
@section('title','Kathit | Payment')
@section('content')
  <section>
    <div class="sn-addtocart-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-0 text-center">Payment Information</h3>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
    </div>
    <div class="payment-container p-0 my-4 my-lg-5">
      <div class="container">
        @php $total = 0 @endphp
        @foreach ( $products as $product )
          @php $total += $product->count * $product->price @endphp
        @endforeach
        @if (count($products) != 0)
          <form class="row gx-lg-5" method="post" action="{{ url('/checkout') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="amount" value="{{ $total }}">
            <div class="col-12 col-md-6">
              <div class="my-4 pay-color">
                <h5 class="mb-4">Our Payment Method</h5>
                <div class="p-3 my-3 d-flex align-items-center pay-method">
                  <input type="radio" id="cashondeli" name="payment_method" value="Cash On Delivery" class="me-3">
                  <label for="cashondeli" class="cashondeli">
                    <h6>Cash On Delivery</h6>
                    <p class="mb-0 text-secondary">You can pay after your order has arrived</p>
                  </label>
                </div>
                <div class="p-3 my-3 d-flex align-items-center pay-method">
                  <input type="radio" id="direct_bank" name="payment_method" value="Direct Bank" class="me-3" checked>
                  <label for="direct_bank" class="direct_bank">
                    <h6>Direct Bank Transfer</h6>
                    <p class="mb-0 text-secondary">Make your payment directly into our bank account.</p>
                  </label>
                </div>
                <div id="cashondeli_panel" class="p-4 my-3 pay-method px-5 d-none">
                  <p class="text-danger bold mb-2">* Please check detail for delivery information</p>
                  <button type="button" class="size-guide" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Delivery Information Detail
                  </button>
                </div>
                <div id="direct_bank_panel" class="p-4 my-3 pay-method px-5">
                  <div class="mb-3">
                    <p class="mb-0">Bank : <span class="highlight">CB</span></p>
                    <p class="mb-0">Account Number : <span class="highlight">0165600500047357</span></p>
                  </div>
                  <div class="mb-3">
                    <p class="mb-0">Bank : <span class="highlight">KBZ</span></p>
                    <p class="mb-0">Account Number : <span class="highlight">07030120800330401</span></p>
                  </div>
                  <div class="mb-3">
                    <p class="mb-0">Bank : <span class="highlight">KBZ ATM</span></p>
                    <p class="mb-0">Account Number : <span class="highlight">36630120800330401</span></p>
                  </div>
                  <div class="mb-3">
                    <p class="mb-0">Bank : <span class="highlight">AYA</span></p>
                    <p class="mb-0">Account Number : <span class="highlight">0137201010068527</span></p>
                  </div>
                  <div class="mb-3">
                    <p class="mb-0">Bank : <span class="highlight">Yoma</span></p>
                    <p class="mb-0">Account Number : <span class="highlight">007144138003204</span></p>
                  </div>
                  <div class="mb-3">
                    <p class="mb-0">Bank : <span class="highlight">KBZ Pay</span></p>
                    <p class="mb-0">Account Number : <span class="highlight">09965409960</span></p>
                  </div>
                  <div class="mb-3">
                    <p class="mb-0">Bank : <span class="highlight">Wave Money</span></p>
                    <p class="mb-0">Account Number : <span class="highlight">09965409960</span></p>
                  </div>
                  <div class="border-top py-4">
                    <p class="highlight">*Please Upload Your Screenshot Payment File</p>
                    {{-- <div class="d-none">
                      <label for="file-upload" class="custom-file-upload">
                          <i class="fa fa-arrow-alt-circle-up me-2"></i>Upload
                      </label>
                      <input id="file-upload" type="file" hidden/>
                    </div> --}}
                    <div>
                      @error('payment_screenshot')
                        <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                      @enderror
                      <input type="file" accept=".jpg,.jpeg,.png" name="payment_screenshot">
                    </div>
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
                      <p class="mb-0 highlight"><a href="{{ url('/product/detail/'.$product->product_id) }}">{{ $product->name }}</a> × {{ $product->count }}</p>
                    </div>
                    <p class="mb-0">{{ $product->count * $product->price }} MMK</p>
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
                  <button class="checkout">Place Order</button>
                  <p class="mt-4 mb-0 text-secondary">*Your order will not be shipped until the funds have cleared in our account.</p>
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
      {{-- Pop up --}}
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
    $(function () {
      $('#cashondeli').click(function() {
        $("#cashondeli_panel").removeClass("d-none");
        $("#direct_bank_panel").addClass("d-none");
      })
      $('#direct_bank').click(function() {
        $("#cashondeli_panel").addClass("d-none");
        $("#direct_bank_panel").removeClass("d-none");
      })
    });
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
    .custom-file-upload {
      background: #eaa89952;
      width: 75%;
      color: #d32f2f;
      text-align: center;
      padding: 10px;
      border-radius: 5px;
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
    .bg-pink {
      background: #eaca9952;
      padding: 40px;
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
    .pay-color input[type="radio"] {
      width: 25px;
      height: 25px;
      cursor: pointer;
      accent-color: #d32f2f;
    }
    .pay-method {
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .payment-container th, .highlight, .payment-container h5, .payment-container h4, .payment-container h6 {
      font-weight: bold;
      color: #3d0000;
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