@extends('layouts.backend.tablelayouts')
@section('title','Kathit | Order Detail')
@push('css')
    <style>
        .photo{
            width: 100px;
            height:100px;
            object-fit: cover;
        }
        .bg-highlight {
          /* height: 80px;*/
          background: #eaca9952 !important; 
        }
        .product-detail-link a {
          color: #d32f2f !important;
          font-weight: bold;
          text-decoration: underline;
          margin-right: 5px;
        }
        .order-detail-container .highlight, .order-detail-container h5, .order-detail-container h4, .order-detail-container h6 {
          font-weight: 600;
          color: #3d0000;
          margin-right: 10px;
        }
        .order-status-change {
          border: 0;
          color: #ffffff !important;
          background-color: #d32f2f;
        }
        .order-status-change:hover {
          background: #3d0000;
          color: #ffffff !important;
        }
        
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-alert></x-alert>
        <x-minibackheader :maintext="'Order Detail'" :subtext="'order detail'"/>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header row no-gutters">
                    <div class="col-12  d-flex justify-content-between">
                      <h3 class="card-title">Order Detail</h3>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body order-detail-container">
                    <form method="post" action="{{url('backend/order/update')}}" enctype="multipart/form-data" class="mb-4">
                      @csrf
                      <label>Order Status</label>
                      <input type="hidden" name="id" value="{{ $payment->id }}">
                      <div class="d-flex">
                        <select class="form-control order-status mr-3" name="status">
                          <option value="pending" {{ old('status',$payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                          <option value="processing" {{ old('status',$payment->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                          <option value="completed" {{old('status',$payment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                          <option value="cancelled" {{old('status',$payment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="order-status-change px-3">Change</button>
                      </div>
                    </form>
                    <div class="">
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
                                <a href="{{url('/product/detail/'.$order->product_id)}}" class="">
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
                                  $dress = App\Models\OrderDressCustomize::where('user_id', $payment->user_id)->where('product_id', $order->product_id)->where('payment_id', $payment->id)->first();
                                  $suit = App\Models\OrderSuitCustomize::where('user_id', $payment->user_id)->where('product_id', $order->product_id)->where('payment_id', $payment->id)->first();
                                @endphp
                                {{-- @if ($dress) --}}
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
                                {{-- @endif --}}
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
                                <i class="fa fa-phone mr-2"></i>{{ $billing->phone }}
                              </li>
                              <li class="my-1">
                                <i class="fa fa-envelope mr-2"></i>{{ $billing->email }}
                              </li>
                            </ul>
                          </td>
                        </tr>
                        </tbody>
                      </table>
                      <div>
                        @if ($payment->payment_screenshot)
                          <h5 class="mt-4 mb-3">Payment Screenshot</h5>
                          <img src="{{ url($payment->payment_screenshot) }}" alt="" class="w-100 ">
                        @endif
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('scripts')
<script>

</script>

@endpush
