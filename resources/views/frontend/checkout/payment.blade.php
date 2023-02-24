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
    <div class="payment-container p-0 my-5">
      <div class="container">
        @php $total = 0 @endphp
        @foreach ( $products as $product )
          @php $total += $product->count * $product->price @endphp
        @endforeach
        @if (count($products) != 0)
          <form class="row gx-lg-5" method="post" action="{{ url('/checkout') }}" enctype="multipart/form-data">
            <div class="col-12 col-md-6">
              
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
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    
  </script>
@endpush

@push('styles')
  <style>
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