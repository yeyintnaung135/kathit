@extends('layouts.frontend.frontend')
@section('title','Kathit | Add To Cart')
@section('content')
  <section>
    <div class="sn-addtocart-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-0 text-center">My Cart</h3>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
    </div>
    
    <div class="addtocart-container p-0 my-5">
      <div class="container">
        @if (count($products) != 0) 
          <div class="row gx-lg-5">
            <div class="col-12 col-lg-8">
              <table class="table">
                <tbody>
                  <tr>
                    <th></th>
                    <th scope="row">Item</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                  </tr>
                  @php $total = 0 @endphp
                  @foreach ( $products as $product )
                  @php $total += $product->count * $product->price @endphp
                    <tr>
                      <td class="img-td">
                        <img src="{{url(App\Models\ProductPhoto::where('product_id', $product->product_id)->value('product_image'))}}" alt="" class="product-img me-0 me-lg-3">
                      </td>
                      <td>
                        <p class="mb-0 highlight"><a href="{{ url('/product/detail/'.$product->product_id) }}">{{ $product->name }}</a></p>
                      </td>
                      <td>
                        <div class="d-flex">
                          <button class="countplus" onclick="countplus({{ $product->id }})"> + </button>
                          <p class="mx-1 mx-lg-3 my-0 my-lg-2">{{ $product->count }}</p>
                          <button class="countminus" onclick="countminus({{ $product->id }})"> - </button>
                        </div>
                      </td>
                      <td class="highlight">{{ $product->count * $product->price }} MMK</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-12 col-lg-4">
              <div class="bg-pink mt-3 mt-lg-0">
                <h5 class="">Order Summary</h5>
                <div class="py-4 d-flex justify-content-between border-bottom">
                  <p class="mb-0 highlight">Sub Total</p>
                  <p class="mb-0">{{ $total }} MMK</p>
                </div>
                <div class="py-4 d-flex justify-content-between order-total">
                  <p class="mb-0 highlight">Total</p>
                  <p class="mb-0">{{ $total }} MMK</p>
                </div>
                <a href="{{ url('/billingaddress') }}" class="checkout">Proceed to checkout</a>
              </div>
            </div>
          </div>
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
    .bg-pink {
      background: #eaca9952;
      padding: 40px;
    }
    .img-td {
      width: 120px;
    }
    .product-img {
      width: 100px;
    }
    .addtocart-container th, .addtocart-container td {
      vertical-align: middle;
      text-align: left;
    }
    .order-total {
      font-weight: bold;
    }
    .removefromcart {
      background: none;
      border: 1px solid;
      display: block;
      vertical-align: middle;
      padding: 0px 8px;
      border-radius: 50px;
    }
    .countplus, .countminus {
      background: #eaa49952;
      border: 0;
      padding: 5px 15px;
      font-weight: bold;
    }
    .addtocart-container th, .highlight, .addtocart-container h5 {
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
      .title-banner .title {
        margin: 0 5%;
      }
      .title-banner .left {
        width: 60px;
      }
      .title-banner .right {
        width: 60px;
      }
      .img-td {
        width: 85px;
      }
      .product-img {
        width: 70px;
      }
      .countplus, .countminus {
        padding: 0 5px;
      }
      .bg-pink {
        padding: 20px;
      }
    }
  </style>
@endpush

@push('scripts')
  <script>
    function countplus(id) {
      console.log('countplus', id);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        url: "{{ url('/updatecart') }}",
        method: "POST",
        data: {
          id: id, 
          qty: 1, 
          type: 'plus',
        },
        success: function(response) {
          window.location.reload();
        },
        error: function(err) {
          console.log('error');
        }
      })
    }
    function countminus(id) {
      console.log('countminus', id);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        url: "{{ url('/updatecart') }}",
        method: "POST",
        data: {
          id: id, 
          qty: 1, 
          type: 'minus',
        },
        success: function(response) {
          window.location.reload();
        },
        error: function(err) {
          console.log('error');
        }
      })
    }
    
  </script>
@endpush

