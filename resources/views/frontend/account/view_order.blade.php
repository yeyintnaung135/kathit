@extends('layouts.frontend.frontend')
@section('title','Kathit | Order')
@section('content')
  <section>
    <div class="sn-addtocart-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-0 text-center">My Order</h3>
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
            <h5 class="mb-3">Order Detail</h5>
            <p>Order #<span style="color: #000;">{{ $payment->id }}</span> was placed on <span
              style="color: #000;">{{ \Carbon\Carbon::parse($payment->created_at)->toFormattedDateString() }}</span>
              and is <span style="color: #000;">{{ $payment->status }}</span>.</p>
              <table class="table mb-0">
                  <tbody class="border">
                  <tr>
                      <th class="px-3 bg-highlight">Product</th>
                      <th class="px-3 bg-highlight">Total</th>
                  </tr>
                  @foreach ( $orders as $order )
                    <tr>
                      <td class="px-3 border product-detail-link">
                        <a href="{{url('/product/detail/'.$order->product_id)}}" class="me-1">
                          {{ $order->product->name }}
                        </a>
                        x {{ $order->count }}
                      </td>
                      <td class="border">{{ $order->price_per_product * $order->count }} Ks</td>
                    </tr>
                  @endforeach
                  <tr>
                      <td class="border">Subtotal:</td>
                      <td class="border">{{ number_format($payment->amount) }} Ks</td>
                  </tr>
                  <tr>
                      <td class="border">Shipping:</td>
                      <td class="border text-muted">Local pickup</td>
                  </tr>
                  <tr>
                      <td class="border">Payment method:</td>
                      <td class="border">{{ $payment->payment_method }}</td>
                  </tr>
                  <tr>
                      <td class="border">Total:</td>
                      <td class="border">{{ number_format($payment->amount) }} Ks</td>
                  </tr>
                  </tbody>
              </table>
              @foreach ( $orders as $order )
              <table class="table table-bordered mb-0 mt-4">
                <tbody>
                <tr>
                  <td class="px-3 bg-highlight" colspan="2">
                    <h5 class="my-2 text-left" style="color: #000;">
                      {{ $order->product->name }} Order Detail
                    </h5>
                  </td>
                </tr>
                <tr>
                  <td class="px-3">
                    <ul class="list-unstyled d-flex flex-column">
                      <li class="my-1"><span class="highlight">Color : </span>{{ $order->color->name }}</li>
                      <li class="my-1"><span class="highlight">Product Type : </span>{{ $order->readytowear_size == NULL ? 'Customize' : 'Ready To Wear' }}</li>
                      @if ($order->readytowear_size == NULL)
                        @php
                          $dress = App\Models\OrderDressCustomize::where('user_id', Auth::user()->id)->where('product_id', $order->product_id)->where('payment_id', $payment->id)->first();
                          $suit = App\Models\OrderSuitCustomize::where('user_id', Auth::user()->id)->where('product_id', $order->product_id)->where('payment_id', $payment->id)->first();
                        @endphp
                        @if ($dress)
                          <li class="my-1 border-top pt-3 mt-3">
                            <h6 class="mb-3">Dress Size</h6>
                            <p><span class="highlight">Shoulder : </span>{{ $dress->shoulder }} {{ $dress->measurement }}</p>
                            <p><span class="highlight">Chest : </span>{{ $dress->chest }} {{ $dress->measurement }}</p>
                            <p><span class="highlight">Bust : </span>{{ $dress->bust }} {{ $dress->measurement }}</p>
                            <p><span class="highlight">Waist : </span>{{ $dress->waist }} {{ $dress->measurement }}</p>
                            <p><span class="highlight">Hips : </span>{{ $dress->hips }} {{ $dress->measurement }}</p>
                            <p><span class="highlight">Neck : </span>{{ $dress->neck }} {{ $dress->measurement }}</p>
                            <p><span class="highlight">Sleeve : </span>{{ $dress->sleeve }} {{ $dress->measurement }}</p>
                            <p><span class="highlight">Length : </span>{{ $dress->length }} {{ $dress->measurement }}</p>
                            <p class="mb-0"><span class="highlight">Waist to Floor : </span>{{ $dress->waist_to_floor }} {{ $dress->measurement }}</p>
                          </li>
                        @endif
                        @if ($suit)
                          <li class="my-1 border-top pt-3 mt-3">
                            <h6 class="mb-3">Suit Size</h6>
                            <p><span class="highlight">Shoulder : </span>{{ $suit->shoulder }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Chest : </span>{{ $suit->chest }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Neck : </span>{{ $suit->neck }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Sleeve : </span>{{ $suit->sleeve }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Top Length : </span>{{ $suit->top_length }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Waist : </span>{{ $suit->waist }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Hips : </span>{{ $suit->hips }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Pants Length : </span>{{ $suit->pants_length }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Thigh Length : </span>{{ $suit->thigh_length }} {{ $suit->measurement }}</p>
                            <p><span class="highlight">Leg Opening : </span>{{ $suit->leg_opening }} {{ $suit->measurement }}</p>
                            <p class="mb-0"><span class="highlight">Inseam : </span>{{ $suit->inseam }} {{ $suit->measurement }}</p>
                          </li>
                        @endif
                      @else
                        <li class="my-1"><span class="highlight">Size : </span>{{ $order->readytowear_size }}</li>
                      @endif
                    </ul>
                  </td>
                </tr>
                </tbody>
              </table>
              @endforeach
              <table class="table table-bordered mb-0 mt-4">
                <tbody>
                <tr>
                  <td class="px-3 bg-highlight" colspan="2">
                    <h5 class="text-uppercase my-2 text-left" style="color: #000;">
                      BILLING ADDRESS
                    </h5>
                  </td>
                </tr>
                <tr>
                  <td class="px-3">
                    <ul class="list-unstyled d-flex flex-column">
                      <li class="my-1">{{ $billing->name }}</li>
                      <li class="my-1">{{ $billing->address }}</li>
                      <li class="my-1">{{ $billing->state }}</li>
                      <li class="my-1">{{ $billing->city }}</li>
                      <li class="my-1">
                        <i class="fa fa-phone me-2"></i>{{ $billing->phone }}
                      </li>
                      <li class="my-1">
                        <i class="fa fa-envelope me-2"></i>{{ $billing->email }}
                      </li>
                    </ul>
                  </td>
                </tr>
                </tbody>
              </table>
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
    .product-detail-link a {
      color: #d32f2f !important;
      font-weight: bold;
      text-decoration: underline;
    }
    .table th, .table td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #dee2e6;
    }

    .status-success span{
      color: #2f8f07;
      padding: 4px;
      border-radius: 3px;
    }
    .status-pending span{
      color: #fbc03a;
      padding: 4px;
      border-radius: 3px;
    }
    .status-error span{
      color: #f92f0f;
      padding: 4px;
      border-radius: 3px;
    }

    .bold {
      font-weight: 600;
    }
    .account-container .sn-view-order {
      border: 0;
      color: #ffffff !important;
      background-color: #d32f2f;
      padding: 10px 35px;
      text-decoration: none;
      letter-spacing: 2px;
    }
    .account-container .sn-view-order:hover {
      background: #3d0000;
      color: #ffffff !important;
    }
    .account-container .highlight, .account-container h5, .account-container h4, .account-container h6 {
      font-weight: 600;
      color: #3d0000;
    }
    .title-banner, .bg-highlight {
      /* height: 80px;*/
      background: #eaca9952 !important; 
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
