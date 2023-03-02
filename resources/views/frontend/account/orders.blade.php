@extends('layouts.frontend.frontend')
@section('title','Kathit | Orders')
@section('content')
  <section>
    <div class="sn-addtocart-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-0 text-center">My Orders</h3>
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
            <h5 class="mb-3">Orders</h5>
            <div class="table-responsive">
              <table class="table mb-0">
                <tbody class="border">
                  <tr>
                    <td class="px-3 bg-white bold">Order</td>
                    <td class="px-3 bg-white bold">Date</td>
                    <td class="px-3 bg-white bold">Status</td>
                    <td class="px-3 bg-white bold">Payment Method</td>
                    <td class="px-3 bg-white bold">Total</td>
                    <td class="px-3 bg-white bold">Actions</td>
                  </tr>
                  @foreach ($orders as $order)
                    <tr class="">
                      <td class="border py-4 order-detail-link"><a href="{{ url('/account/view-order/'.$order->id) }}">#{{ $order->id }}</a></td>
                      <td class="border py-4"> {{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }} </td>
                      @if ($order->status == 'success')
                        <td class="border py-4 bold status-success"> <span>{{ $order->status }}</span> </td>
                      @elseif ($order->status == 'pending')
                        <td class="border py-4 bold status-pending"> <span>{{ $order->status }}</span> </td>
                      @else
                        <td class="border py-4 bold status-error"> <span>{{ $order->status }}</span> </td>
                      @endif
                        <td class="border py-4 bold"> <span>{{ $order->payment_method }}</span> </td>
  
                        <td class="border py-4">{{ number_format($order->amount) }} MMK</td>
                      <td class="border py-4"><a href="{{ url('/account/view-order/'.$order->id) }}" class="sn-view-order">VIEW</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
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
    .order-detail-link a {
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
