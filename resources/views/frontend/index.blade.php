@extends('layouts.frontend.frontend')
@section('title','Kathit | Home')
@push('styles')
  <style>
    .product-container .mySwiper ul {
      list-style: none;
    }
    .product-container .mySwiper li {
      width: auto;
    }
    .product-container .mySwiper button {
      text-align: left;
      color: #818181;
      /* font-weight: 600; */
      font-size: 18px;
    }
    .see-all-products {
      width: 100px;
      display: block;
      font-weight: bold;
      color: #d32f2f;
      text-align: right;
    }
    .see-all-products:hover {
      color: #3d0000;
    }
    .product-container h4 {
      font-weight: bold;
      text-align: center;
    }
    .product-container hr {
      width: 100px;
      margin: 0 auto;
      border: 2px solid #d32f2f;
      border-radius: 50px;
      opacity: 1;
    }
    .banner-overlay {
      position: absolute; 
      bottom: 0; 
      width: 100%;
      height: 100%;
      transition: .5s ease;
      padding: 12px;
      text-align: left;
    }
    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .swiper {
      width: 100%;
      /* height: 300px;*/
      height: auto;
      margin-left: auto;
      margin-right: auto;
    }
    .sn-main-banner  {
      height: 100% !important;
      aspect-ratio: 3/2;
    }
    .sn-main-banner img {
      object-fit: cover;
      object-position: 35%;
    }
    .swiper-slide {
      background-size: cover;
      background-position: center;
    }

    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
      color: #000;
      background-color: #fff !important;
      border-color: #fff !important;
    }
    .nav-tabs {
      border-bottom: #fff !important;
    }
    .see-all-products .fa-chevron-right {
      font-size: 12px;
    }
    #myproductContent a:hover {
      color: #333;
    }

    #myproductContent .product-img {
      width: 100%;
      aspect-ratio: 1/1;
      object-fit: cover;
    }
    #myproductContent .img-wrapper {
      background: #eaca9952;
    }
    #myproductContent .product-name {
      margin-top: 18px;
      font-weight: 600;
      font-size: 18px;
      color: #333;
    }
    #myproductContent .product-price {
      color: #d32f2f;
      font-weight: 600;
      font-size: 15px;
    }
    .see-all-products-mobile {
      display: block;
      margin: 0 auto;
      text-align: center;
      width: 50%;
      background: #eaca9952;
      border: 1px solid #d32f2f;
      border-radius: 2px;
      color: #d32f2f;
      padding: 5px;
      margin-top: 25px;
      font-weight: bold;
    }
    .banner-text {
      width: 65%;
      margin-left: 35%;
      margin-top: 3%;
    }
    .banner-text h4 {
      font-weight: bold;
      line-height: 1.8rem;
      font-size: 16px;
      margin-bottom: 0;
    }
    .banner-highlight {
      color: #d32f2f;
    }
    .banner-button {
      border: 1px solid #d32f2f;
      border-radius: 3px;
      background: #d32f2f;
      color: #fff;
      font-weight: bold;
      padding: 6px 18px;
      font-size: 14px;
    }
    .banner-button:hover {
      background: #d32f2f00;
      color: #d32f2f;
    }
    .banner-tips {
      font-size: 10px;
      justify-content: space-between;
    }

    /* Desktop Size */
    @media only screen and (min-width: 786px) {
      #myproductContent .product-name {
        font-size: 20px;
      }
      #myproductContent .product-price {
        font-size: 17px;
      }
      .banner-text h4 {
        font-size: 24px;
        line-height: 2.8rem;
      }
      .banner-tips {
        font-size: 16px;
        justify-content: flex-start;
      }
      .banner-text {
        width: 50%;
        margin-left: 50%;
        margin-top: 6%;
      }
      .sn-main-banner  {
        aspect-ratio: 6/2;
      }
      .sn-main-banner img {
        object-position: initial;
      }
      
    }
    
    @media only screen and (min-width: 500px) and (max-width: 786px){
      .banner-text {
        width: 50%;
        margin-left: 50%;
        margin-top: 3%;
      }
      .banner-text h4 {
        font-size: 16px;
      }
      .banner-button {
        font-size: 16px;
      }
      .banner-overlay {
        padding: 20px;
      }
      .banner-tips {
        font-size: 12px;
        justify-content: flex-start;
      }
    }

    @media only screen and (min-width: 600px) and (max-width:957px) {
      .banner-text {
        margin-top: 1%;
      }

      .banner-text h4 {
        font-size: 24px;
        line-height: 2.8rem;
      }
      .banner-tips {
        font-size: 16px;
        justify-content: flex-start;
      }
      .banner-btn-con {
        margin: 20px auto !important;
      }
    }
  </style>
@endpush

@section('content')
  <section>
    <div class="sn-main-banner swiper myBannerSwiper">
        <div class="swiper-wrapper">
          @foreach ( $banners as $banner )
            <div class="swiper-slide position-relative">
              <img src="{{ url($banner->image) }}" alt="Kathit">
              <div class="banner-overlay position-absolute">
                <div class="banner-text">
                  <h4 class="fon">ခန့်ငြားဆန်းသစ် ချက်ချင်းရောက်မှာ <span class="banner-highlight">သင်တို့ရဲ့ ကသစ်</span></h4>
                  <h4>Now to you ဆိုတာ <span class="banner-highlight">Kathit</span> ပါ</h4>
                  <div class="my-2 my-md-4 py-1 py-lg-2 banner-btn-con">
                    <a href="#" class="banner-button">Shop Now</a>
                  </div>
                  <p class="mb-2 mb-md-3 mb-lg-5">Support Our Local Brand <span class="banner-highlight">Kathit Fashion</span></p>
                  <div class="d-flex banner-tips">
                    <div class="me-1 me-lg-4"><i class="fa fa-check-circle banner-highlight me-1 me-lg-2"></i>Fashionable</div>
                    <div class="me-1 me-lg-4"><i class="fa fa-check-circle banner-highlight me-1 me-lg-2"></i>Comfortable</div>
                    <div class="me-1 me-lg-4"><i class="fa fa-check-circle banner-highlight me-1 me-lg-2"></i>Fair Price</div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="swiper-pagination d-none"></div>
    </div>

    <div class="product-container container p-0 my-5">
      <h4>Popular Items</h4>
      <hr>
      <div class="d-flex justify-content-between align-items-center mt-4 pt-2 px-3 px-lg-0">
        <div class="swiper mySwiper">
          <ul class="nav-tabs swiper-wrapper p-0 mb-0" id="myTab" role="tablist">
            <li class="nav-item me-4 pe-2 swiper-slide" role="presentation">
              <button class="nav-link active p-0" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All Products</button>
            </li>
            <li class="nav-item me-4 pe-2 swiper-slide" role="presentation">
              <button class="nav-link p-0" id="dress-tab" data-bs-toggle="tab" data-bs-target="#dress" type="button" role="tab" aria-controls="dress" aria-selected="false">Dress</button>
            </li>
            <li class="nav-item me-4 pe-2 swiper-slide" role="presentation">
              <button class="nav-link p-0" id="mmdress-tab" data-bs-toggle="tab" data-bs-target="#mmdress" type="button" role="tab" aria-controls="mmdress" aria-selected="false">Myanmar Dress</button>
            </li>
            <li class="nav-item me-4 pe-2 swiper-slide" role="presentation">
              <button class="nav-link p-0" id="men-tab" data-bs-toggle="tab" data-bs-target="#men" type="button" role="tab" aria-controls="men" aria-selected="false">Men's wear</button>
            </li>
            <li class="nav-item me-0 swiper-slide" role="presentation">
              <button class="nav-link p-0" id="women-tab" data-bs-toggle="tab" data-bs-target="#women" type="button" role="tab" aria-controls="women" aria-selected="false">Women's wear</button>
            </li>
          </ul>
        </div>
        <div class="d-none d-lg-block">
          <a href="{{ url('/products') }}" class="see-all-products">SEE ALL <i class="fa fa-chevron-right ms-1"></i><i class="fa fa-chevron-right"></i></a>
        </div>
      </div>
      <div class="tab-content px-3 px-lg-0 pt-4" id="myproductContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
          <div class="row gx-3 gy-3 gx-lg-4 gy-lg-4">
            @foreach($all_products as $all)
              <a href="{{url('/product/detail/'.$all->id)}}" class="col-6 col-lg-4 mb-2 mb-lg-4">
                <div class="img-wrapper">
                  <img src="{{ asset($all->getProductPhotos[0]->product_image)}}" alt="" class="product-img">
                </div>
                <h5 class="product-name">{{ $all->name }}</h5>
                <span class="product-price">{{ $all->price }} MMK</span>
              </a>
            @endforeach
          </div>
        </div>
        <div class="tab-pane fade" id="dress" role="tabpanel" aria-labelledby="dress-tab">
          <div class="row gx-3 gy-3 gx-lg-4 gy-lg-4">
            @foreach($dresses as $dress)
              <a href="{{url('/product/detail/'.$dress->id)}}" class="col-6 col-lg-4 mb-2 mb-lg-4">
                <div class="img-wrapper">
                  <img src="{{ asset($dress->getProductPhotos[0]->product_image)}}" alt="" class="product-img">
                </div>
                <h5 class="product-name">{{ $dress->name }}</h5>
                <span class="product-price">{{ $dress->price }} MMK</span>
              </a>
            @endforeach
          </div>
        </div>
        <div class="tab-pane fade" id="mmdress" role="tabpanel" aria-labelledby="mmdress-tab">
          <div class="row gx-3 gy-3 gx-lg-4 gy-lg-4">
            @foreach($mm_dresses as $mm_dress)
              <a href="{{url('/product/detail/'.$mm_dress->id)}}" class="col-6 col-lg-4 mb-2 mb-lg-4">
                <div class="img-wrapper">
                  <img src="{{ asset($mm_dress->getProductPhotos[0]->product_image)}}" alt="" class="product-img">
                </div>
                <h5 class="product-name">{{ $mm_dress->name }}</h5>
                <span class="product-price">{{ $mm_dress->price }} MMK</span>
              </a>
            @endforeach
          </div>  
        </div>
        <div class="tab-pane fade" id="men" role="tabpanel" aria-labelledby="men-tab">
          <div class="row gx-3 gy-3 gx-lg-4 gy-lg-4">
            @foreach($men_wears as $men_wear)
              <a href="{{url('/product/detail/'.$men_wear->id)}}" class="col-6 col-lg-4 mb-2 mb-lg-4">
                <div class="img-wrapper">
                  <img src="{{ asset($men_wear->getProductPhotos[0]->product_image)}}" alt="" class="product-img">
                </div>
                <h5 class="product-name">{{ $men_wear->name }}</h5>
                <span class="product-price">{{ $men_wear->price }} MMK</span>
              </a>
            @endforeach
          </div>
        </div>
        <div class="tab-pane fade" id="women" role="tabpanel" aria-labelledby="women-tab">
          <div class="row gx-3 gy-3 gx-lg-4 gy-lg-4">
            @foreach($women_wears as $women_wear)
              <a href="{{url('/product/detail/'.$women_wear->id)}}" class="col-6 col-lg-4 mb-2 mb-lg-4">
                <div class="img-wrapper">
                  <img src="{{ asset($women_wear->getProductPhotos[0]->product_image)}}" alt="" class="product-img">
                </div>
                <h5 class="product-name">{{ $women_wear->name }}</h5>
                <span class="product-price">{{ $women_wear->price }} MMK</span>
              </a>
            @endforeach
          </div>
        </div>
      </div>
      <div class="d-block d-lg-none">
        <a href="#" class="see-all-products-mobile">See All <i class="fa fa-arrow-right ms-2"></i> </a>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    var bannerSwiper = new Swiper(".myBannerSwiper", {
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: "auto",
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      }
    });
  </script>
@endpush