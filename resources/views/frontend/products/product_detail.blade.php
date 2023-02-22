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
            <h4 class="pd-name">{{ $data->name }}</h4>
            <p class="pd-price my-3">{{ $data->price }} MMK</p>
            @if (count($colors) > 0)
            <div class="my-4 pb-1 pd-color">
              <h5 class="mb-3">Color</h5>
              <div class="d-flex flex-wrap">
                @foreach ($colors as $index => $color)
                  @if ($index == 0)
                    <div class="me-2">
                      <input type="radio" id="{{ $color->name }}" name="color" value="{{ $color->name }}" class="radio-color" checked>
                      <label for="{{ $color->name }}" class="{{ $color->name }}" style="background: {{ $color->code }};"></label>
                    </div>
                  @else
                    <div class="me-2">
                      <input type="radio" id="{{ $color->name }}" name="color" value="{{ $color->name }}" class="radio-color">
                      <label for="{{ $color->name }}" class="{{ $color->name }}" style="background: {{ $color->code }};"></label>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
            @endif
            @if ($data->type == 'readytowear')
              <div class="my-4 py-1 pd-size">
                <div class="d-flex justify-content-between align-self-end mb-3">
                  <h5 class="mb-0">Size</h5>
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
            @elseif ($data->type == 'customize')
              <div class="my-4 py-1 pd-cus">
                <a href="{{ url('/customize/'.$data->id) }}" class="d-flex justify-content-between align-items-center align-self-center">
                  <span>Customize Your Dress</span>
                  <i class="fa fa-arrow-right float-end"></i>
                </a>
              </div>
            @endif
            <div class="my-3 pd-button d-flex">
              <button class="pd-atc">Add To Cart</button>
              <a href="#" class="pd-buynow">Buy It Now</a>
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
                      <span class="product-price">{{ $s->price }} MMK</span>
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
    .pd-cus {
      background: #eaca9952;
      border-radius: 5px;
    }
    .pd-cus a {
      color: #d32f2f;
      padding: 9px 30px;
      font-weight: bold;
    }
    .modal-dialog {
      max-width: 100% !important;
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
  </script>
@endpush