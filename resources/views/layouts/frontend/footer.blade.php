@push('styles')
  <style>
    .main-footer {
      background: #d32f2f;
      color: #fff;
    }
    .main-footer ul {
      list-style: none;
      padding: 0;
      line-height: 1.7rem;
      font-weight: 600;
    }
    .main-footer a {
      text-decoration: none;
      color: #fff;
    }
    .main-footer h4 {
      font-weight: 600;
    }
    .copyright a {
      color: rgb(27, 183, 255);
      font-weight: 900;
    }
    .facebook, .messenger, .twitter, .pinterest, .youtube,
    .telegram, .tiktok, .instagram {
      margin-right: 15px;
      margin-top: 15px;
      margin-right: 15px;
      margin-top: 15px;
      background: #fff;
      border-radius: 50%;
      border: 1px solid;
    }
    .facebook, .messenger {
      width: 25px;
    }
    .pinterest, .youtube, .twitter, .telegram, .tiktok, .instagram {
      width: 27px;
    }
    
    @media screen and (max-width: 600px) {
      .main-footer ul {
        font-size: 12px;
      }
      .main-footer h4 {
        font-size: 20px;
      }
    }
  </style>
@endpush
<footer class="main-footer p-3 p-lg-5 pb-lg-4">
  <div class="container">
    <div class="row">
      <div class="col-3 col-lg-3 px-0 pe-2 pe-lg-0">
        <h4 class="mb-2 mb-lg-3">Menu</h4>
        <ul>
          <a href="{{url('/')}}"><li>Home</li></a>
          <a href="{{url('about')}}"><li>About</li></a>
          <a href="{{url('products')}}"><li>Product</li></a>
          <a href="{{url('videos')}}"><li>Video</li></a>
          <a href="{{url('contact')}}"><li>Contact</li></a>
          <a href="{{url('account')}}"><li>Account</li></a>
        </ul>
      </div>
      <div class="col-3 col-lg-3 px-0 pe-2 pe-lg-0">
        <h4 class="mb-2 mb-lg-3">Product</h4>
        <ul>
          <a href="{{url('products-category/dress/1')}}"><li>Dress</li></a>
          <a href="{{url('products-category/traditional-dress/2')}}"><li>Traditional Dress</li></a>
          <a href="{{url('products-category/men-wear/3')}}"><li>Men's Wear</li></a>
          <a href="{{url('products-category/women-wear/4')}}"><li>Women's Wear</li></a>
        </ul>
      </div>
      <div class="col-4 col-lg-3 d-none d-lg-block px-0">
        <h4 class="mb-2 mb-lg-3">Contact</h4>
        <ul>
          <a href="mailto:Kathit.1976@gmail.com"><li>Email : Kathit.1976@gmail.com</li></a>
          <a href="tel:09965409960"><li>Phone : 09965409960</li></a>
        </ul>
      </div>
      <div class="col-4 col-lg-3 d-none d-lg-block px-0">
        <h4 class="mb-2 mb-lg-3">Get in touch</h4>
        <ul>
          <li>Follow us on social media</li>
          <li>
            <a href="https://www.facebook.com/HT2276?mibextid=LQQJ4d"><img src="{{ asset('images/icons/facebook.png')}}" alt="" class="facebook"></a>
            <a href="http://m.me/kathitfashion"><img src="{{ asset('images/icons/messenger.png')}}" alt="" class="messenger"></a>
            <a href="https://twitter.com/hnaung_thway/status/1579427882174382080?s=46&t=StxE4o5zxEGjZC3edOEBOQ"><img src="{{ asset('images/icons/twitter.png')}}" alt="" class="twitter"></a>
            <a href="https://pin.it/7FE0oc7"><img src="{{ asset('images/icons/pinterest.png')}}" alt="" class="pinterest"></a>
            <a href="https://youtube.com/@kathit3597"><img src="{{ asset('images/icons/youtube.png')}}" alt="" class="youtube"></a>
            <a href="https://t.me/Hnaung_Thway"><img src="{{ asset('images/icons/telegram.png')}}" alt="" class="telegram"></a>
            <a href="https://www.tiktok.com/@ht002276?is_from_webapp=1&sender_device=pc"><img src="{{ asset('images/icons/tiktok.png')}}" alt="" class="tiktok"></a>
            <a href="https://instagram.com/kathit51?igshid=YWJhMjlhZTc="><img src="{{ asset('images/icons/instagram.png')}}" alt="" class="instagram"></a>
          </li>
        </ul>
      </div>

      <div class="col-6 d-block d-lg-none px-0">
        <h4 class="mb-2 mb-lg-3">Contact</h4>
        <ul>
          <a href="mailto:Kathit.1976@gmail.com"><li>Email : Kathit.1976@gmail.com</li></a>
          <a href="tel:09965409960"><li>Phone : 09965409960</li></a>
        </ul>
        <h4>Get in touch</h4>
        <ul>
          <li>Follow us on social media</li>
          <li>
            <a href="https://www.facebook.com/HT2276?mibextid=LQQJ4d"><img src="{{ asset('images/icons/facebook.png')}}" alt="" class="facebook"></a>
            <a href="http://m.me/kathitfashion"><img src="{{ asset('images/icons/messenger.png')}}" alt="" class="messenger"></a>
            <a href="https://twitter.com/hnaung_thway/status/1579427882174382080?s=46&t=StxE4o5zxEGjZC3edOEBOQ"><img src="{{ asset('images/icons/twitter.png')}}" alt="" class="twitter"></a>
            <a href="https://pin.it/7FE0oc7"><img src="{{ asset('images/icons/pinterest.png')}}" alt="" class="pinterest"></a>
            <a href="https://youtube.com/@kathit3597"><img src="{{ asset('images/icons/youtube.png')}}" alt="" class="youtube"></a>
            <a href="https://t.me/Hnaung_Thway"><img src="{{ asset('images/icons/telegram.png')}}" alt="" class="telegram"></a>
            <a href="https://www.tiktok.com/@ht002276?is_from_webapp=1&sender_device=pc"><img src="{{ asset('images/icons/tiktok.png')}}" alt="" class="tiktok"></a>
            <a href="https://instagram.com/kathit51?igshid=YWJhMjlhZTc="><img src="{{ asset('images/icons/instagram.png')}}" alt="" class="instagram"></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div>
    <p class="text-center mb-0 mt-2 copyright">Copyright @ 2023 Kathit | CREATE BY <a href="https://myanmaronlinetechnology.com/">MOT</a></p>
  </div>
</footer>