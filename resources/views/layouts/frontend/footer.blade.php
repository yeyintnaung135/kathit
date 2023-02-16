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
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div>
    <p class="text-center mb-0 mt-2 copyright">Copyright @ 2023 Kathit | CREATE BY <a href="https://myanmaronlinetechnology.com/">MOT</a></p>
  </div>
</footer>

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
    .facebook, .messenger {
      width: 25px;
      margin-right: 15px;
      margin-top: 15px;
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