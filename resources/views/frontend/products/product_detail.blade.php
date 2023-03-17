@extends('layouts.frontend.frontend')
@section('content')
  <section>
    <div class="pd-container my-3 my-lg-4 p-0">
      <div class="container p-lg-0 mb-5">
        <div class="row">
          <div class="col-12 col-md-6 pe-lg-4">
            <div class="position-relative">
              <div class="swiper productDetailSwiper">
                  <div class="swiper-wrapper">
                    @foreach ($data->getProductPhotos as $photo )
                    <div class="swiper-slide" data-src="{{ url($photo->product_image) }}"
                          data-fancybox="product_detail">
                      <img src="{{ url($photo->product_image) }}"/>
                    </div>
                    @endforeach
                  </div>
              </div>
              <div thumbsSlider="" class="swiper productDetailSwiperthumb">
                  <div class="swiper-wrapper">
                    @foreach ($data->getProductPhotos as $photo )
                      <div class="swiper-slide">
                        <img src="{{ url($photo->product_image) }}"/>
                      </div>
                    @endforeach
                  </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 ps-lg-5 mt-3 mt-lg-0">
            <input type="hidden" name="product_id" value="{{ $data->id }}" id="product_id">
            <h4 class="pd-name">{{ $data->name }}</h4>
            <p class="pd-price my-3">{{ in_array('readytowear', json_decode($data->type)) ? $data->s_price : $data->customize_price }} MMK</p>
            @if (count($colors) > 0)
            <div class="my-4 pb-1 pd-color">
              <h5 class="mb-3">Color</h5>
              <div class="d-flex flex-wrap">
                @foreach ($colors as $index => $color)
                  @if ($index == 0)
                  @php $default_color = $color->id @endphp
                    <div class="me-2">
                      <input type="radio" id="{{ $color->name }}" name="color" value="{{ $color->id }}" class="radio-color" checked>
                      <label for="{{ $color->name }}" class="{{ $color->name }}" style="background: {{ $color->code }};"></label>
                    </div>
                  @else
                    <div class="me-2">
                      <input type="radio" id="{{ $color->name }}" name="color" value="{{ $color->id }}" class="radio-color">
                      <label for="{{ $color->name }}" class="{{ $color->name }}" style="background: {{ $color->code }};"></label>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
            @endif
            <div class="my-4 py-1">
              @if (count(json_decode($data->type)) > 1)
                <div class="d-flex pt-1 choose_size justify-content-center align-items-center">
                  <div class="w-50 me-2">
                    <button class="w-100 d-flex justify-content-center align-items-center" id="readymade_button">
                      <img src="{{ url('/images/icons/readytowear.png') }}" alt="customize" class="">
                      <p class="mb-0">Choose Readymade Size</p>
                    </button>
                  </div>
                  <div class="w-50 ms-2">
                    <a href="{{ url('/customize/'.$data->id) }}" class="w-100 d-flex justify-content-center align-items-center">
                      <img src="{{ url('/images/icons/customize.png') }}" alt="customize" class="">
                      <p class="mb-0">Customize Your Size</p>
                    </a>
                  </div>
                </div>
                <div class="mt-4 pt-1 pd-size d-none" id="readymade_panel">
                  <div class="d-flex justify-content-between align-self-end mb-3">
                    <h5 class="mb-0">Ready Made Size</h5>
                    <button type="button" class="size-guide" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Size Guide
                    </button>
                  </div>
                  <div class="row gx-3">
                    <div class="col">
                      <input type="radio" id="size-small" name="size" value="S" class="radio-size" checked>
                      <label for="size-small">S</label>
                    </div>
                    <div class="col">
                      <input type="radio" id="size-medium" name="size" value="M" class="radio-size">
                      <label for="size-medium">M</label>
                    </div>
                    <div class="col">
                      <input type="radio" id="size-large" name="size" value="L" class="radio-size">
                      <label for="size-large">L</label>
                    </div>
                    <div class="col">
                      <input type="radio" id="size-xlarge" name="size" value="XL" class="radio-size">
                      <label for="size-xlarge">XL</label>
                    </div>
                    <div class="col">
                      <input type="radio" id="size-2xlarge" name="size" value="XXL" class="radio-size">
                      <label for="size-2xlarge">XXL</label>
                    </div>
                  </div>
                </div>
              @endif
            </div>
            
            @if (count(json_decode($data->type)) == 1 && in_array('readytowear', json_decode($data->type)))
              <div class="my-4 py-1 pd-size">
                <div class="d-flex justify-content-between align-self-end mb-3">
                  <h5 class="mb-0">Ready Made Size</h5>
                  <button type="button" class="size-guide" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Size Guide
                  </button>
                </div>
                <div class="row gx-3">
                  <div class="col">
                    <input type="radio" id="size-small" name="size" value="S" class="radio-size" checked>
                    <label for="size-small">S</label>
                  </div>
                  <div class="col">
                    <input type="radio" id="size-medium" name="size" value="M" class="radio-size">
                    <label for="size-medium">M</label>
                  </div>
                  <div class="col">
                    <input type="radio" id="size-large" name="size" value="L" class="radio-size">
                    <label for="size-large">L</label>
                  </div>
                  <div class="col">
                    <input type="radio" id="size-xlarge" name="size" value="XL" class="radio-size">
                    <label for="size-xlarge">XL</label>
                  </div>
                  <div class="col">
                    <input type="radio" id="size-2xlarge" name="size" value="XXL" class="radio-size">
                    <label for="size-2xlarge">XXL</label>
                  </div>
                </div>
              </div>
            @endif
            @if (count(json_decode($data->type)) == 1 && in_array('customize', json_decode($data->type)))
              <h5 class="mb-0">Custom Size</h5>
              <div class="mt-3 mb-4 py-1 pd-cus d-none">
                <a href="{{ url('/customize/'.$data->id) }}" class="d-flex justify-content-between align-items-center align-self-center">
                  <span>Customize Your Size and Place Order</span>
                  <i class="fa fa-arrow-right float-end"></i>
                </a>
              </div>
              <div class="mt-3 mb-4 py-1 pd-cus">
                <form method="post" action="{{ url('/customize') }}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $data->id }}">
                  <input type="hidden" name="selected_color" value="{{ $default_color }}">
                  <input type="hidden" name="price_per_product" value="{{ $data->customize_price }}">
                  <button type="submit" class="d-flex justify-content-between align-items-center align-self-center">
                    <span class="me-3">Customize Your Size and Place Order</span>
                    <i class="fa fa-arrow-right float-end"></i>
                  </button>
                </form>
              </div>
            @endif
            <div class="my-3 pd-button d-flex">
              <button class="pd-atc" onclick="addtocart('a2c')">Add To Cart</button>
              <button class="pd-buynow" onclick="addtocart('buynow')">Buy It Now</button>
              {{-- <a href="#" class="pd-buynow">Buy It Now</a> --}}
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Description
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">{!! $data->short_desc !!}</div>
                </div>
              </div>
              <div class="">
                <h2 class="accordion-header" id="flush-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    About Product
                  </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">{!! $data->description !!}</div>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <img src="{{ url('/images/sizeguide/sizeguide1.jpg') }}" alt="Kathit" class="w-100">
                  <br>
                  <br>
                  <img src="{{ url('/images/sizeguide/sizeguide2.jpg') }}" alt="Kathit" class="w-100">
                </div>
              </div>
            </div>
          </div>
          <!-- End of Modal -->

        </div>

        @if(count($sim) > 0)
        <div class="pd-recommendation mt-5">
          <h4 class="my-4">Recommendation Products</h4>
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              @foreach($sim as $s)
                <div class="swiper-slide">
                  <div class="">
                    <a href="{{url('/product/detail/'.$s->id)}}" class="">
                      <div class="img-wrapper">
                        <img src="{{ asset($s->getProductPhotos[0]->product_image)}}" alt="" class="product-img">
                      </div>
                      <h5 class="product-name">{{ $s->name }}</h5>
                      <span class="product-price">{{ $s->customize_price ? $s->customize_price : $s->s_price .' MMK to '. $s->xxl_price }} MMK</span>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>
@endsection
@push('styles')
  <style>
    .choose_size img {
      width: 20px !important;
      margin-right: 8px;
    }
    .choose_size button, .choose_size a {
      background: transparent;
      border: 1px solid #d32f2f1a;
      height: 75px;
      border-radius: 5px;
      box-shadow: 0px 0px 7px 1px #d32f2f26;
      padding: 0 12px;
    }
    .choose_size p {
      color: #d32f2f;
      text-align: center;
    }
    .choosen_type {
      border: 1px solid #bd1c1c !important; 
    }
    .pd-cus {
      background: #eaca9952;
      border-radius: 5px;
    }
    .pd-cus a {
      color: #d32f2f;
      padding: 9px 30px;
      font-weight: bold;
    }
    .pd-cus button {
      background: transparent;
      width: 100%;
      border: none;
      color: #d32f2f;
      padding: 9px 30px;
      font-weight: bold;
    }
    #exampleModal .modal-dialog {
      max-width: 90% !important;
    }
    .radio-color {
      display: none;
    }
    .pd-color label {
      position: relative;
      display: inline-block;
      height: 23px;
      width: 23px;
      background: #333;
      border-radius: 50%;
      margin-right: 8px;
      z-index: 1;
      cursor: pointer;
    }
    .pd-color input[type=radio]:checked + label:after {
      content: "";
      position: absolute;
      top: -3px;
      left: -3px;
      height: 29px;
      width: 29px;
      border: solid 2px #333;
      border-radius: 50%;
      z-index: 0;
    }

    .pd-name, .pd-recommendation h4 {
      font-weight: bold;
      color: #3d0000;
    }

    .pd-price {
      font-weight: bold;
      color: #d32f2f;
      font-size: 18px;
    }

    .pd-button .pd-atc {
      background: none;
      border: 1px solid #3d0000;
      border-radius: 4px;
      color: #3d0000;
      font-weight: bold;
      padding: 8px 40px;
      margin-right: 13px;
      width: 50%;
    }
    .pd-button .pd-atc:hover {
      background: #3d0000;
      color: #fff;
    }

    .pd-button .pd-buynow {
      background: #d32f2f;
      border: 1px solid #d32f2f;
      border-radius: 4px;
      color: #fff;
      font-weight: bold;
      padding: 10px 40px;
      width: 50%;
      display: block;
      text-align: center;
    }

    .pd-button .pd-buynow:hover {
      background: none;
      color: #d32f2f;
    }
    .radio-size {
      display: none;
    }
    .radio-size:checked ~ label {
      background: #3d0000;
      color: #fff;
    }
    .pd-size label {
      width: 100%;
      border: 1px solid #3d00008c;
      text-align: center;
      font-weight: bold;
      padding: 7px 0;
      border-radius: 3px;
    }
    .size-guide {
      background: none;
      border: 0px;
      border-bottom: 1px solid #000 !important;
      padding: 0;
    }
    #exampleModal .modal.show .modal-dialog {
      margin: 20px auto !important;
    }

    .productDetailSwiper {
      height: 80%;
      width: 100%;
    }
    .productDetailSwiperthumb {
      height: 20%;
      box-sizing: border-box;
      padding: 10px 0;
    }
    .productDetailSwiperthumb .swiper-slide {
      width: 25%;
      height: 100%;
      opacity: 0.4;
    }
    .productDetailSwiperthumb .swiper-slide-thumb-active {
      opacity: 1;
    }
    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      background: #eaca9952;
      aspect-ratio: 1/1;
    }
    .swiper {
      width: 100%;
      height: 100%;
      margin-left: auto;
      margin-right: auto;
      /* aspect-ratio: 1/1; */
    }
    .swiper-slide {
      background-size: cover;
      background-position: center;
    }
    .sn-swiper-wrapper a {
      display: block;
      width: 130px;
    }
    .productDetailSwiperthumb {
      height: 20%;
    }
    .accordion-button {
      padding-left: 0 !important;
      background: none !important;
      font-weight: bold !important;
    }
    .accordion-button:not(.collapsed) {
      box-shadow: none !important;
    }
    .accordion-button:focus {
      box-shadow: none !important;
    }

    .pd-recommendation .img-wrapper {
      background: #eaca9952;
    }
    .pd-recommendation a:hover {
      color: #333;
    }

    .pd-recommendation .product-img {
      width: 100%;
      aspect-ratio: 1/1;
      object-fit: cover;
    }
    .pd-recommendation .img-wrapper {
      background: #eaca9952;
    }
    .pd-recommendation .product-name {
      margin-top: 18px;
      font-weight: 600;
      font-size: 18px;
    }
    .pd-recommendation .product-price {
      color: #d32f2f;
      font-weight: 600;
      font-size: 15px;
    }
  </style>
@endpush
@push('scripts')
  <script>
    var swiper = new Swiper(".productDetailSwiperthumb", {
        loop: false,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: false,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".productDetailSwiper", {
        loop: false,
        spaceBetween: 10,
        thumbs: {
            swiper: swiper,
        },
    });
    var swiper3 = new Swiper(".mySwiper", {
      slidesPerView: 2,
      spaceBetween: 15,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 15,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 15,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 15,
        },
      },
    });

    function addtocart (info) {

      var product_id = $('#product_id').val();
      var color = $('input[name="color"]:checked').val();
      var readytowear_size = $('input[name="size"]:checked').val();
      var price_per_product = parseInt($('.pd-price').html().replace(" MMK", ""));

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })

      $.ajax({
        url: "{{ url('/storeproducttocart') }}",
        method: "POST",
        data: {
          product_id: product_id, 
          qty: 1, 
          color: color, 
          readytowear_size: readytowear_size,
          price_per_product: price_per_product
        },
        success: function(response) {
          if(response.error == 'needtologin') {
            window.location.href = "{{ url('/login')}}";
          } else if (response.error == 'needtocustomize') {
            window.location.href = `{{ url('/customize/${response.product_id}') }}`;
          } else {
            if(info == 'buynow') {
              window.location.href = `{{ url('/billingaddress') }}`;
            } else {
              window.location.reload();
            }
          }
        },
        error: function(err) {
          console.log('error');
        }
      })
    }

    $('input[type=radio][name=size]').change(function() {
      var product = {!! $data !!};
      switch(this.value) {
        case 'S':
          $('.pd-price').html(product.s_price + ' MMK');
          break;
        case 'M':
          $('.pd-price').html(product.m_price + ' MMK');
          break;
        case 'L':
          $('.pd-price').html(product.l_price + ' MMK');
          break;
        case 'XL':
          $('.pd-price').html(product.xl_price + ' MMK');
          break;
        case 'XXL':
          $('.pd-price').html(product.xxl_price + ' MMK');
          break;
      }
    })

    $('input[type=radio][name=color]').change(function() {
      $('input[name=selected_color]').val(this.value);
    })

    $('#readymade_button').click(function() {
      $('#readymade_panel').toggleClass('d-none');
      $('#readymade_button').toggleClass('choosen_type');
    })
  </script>
@endpush