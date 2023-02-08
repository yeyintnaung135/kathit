<footer class="main-footer p-3 p-lg-5 pb-lg-4">
  <div class="container">
    <div class="row">
      <div class="col-3 col-lg-3 px-0 pe-2 pe-lg-0">
        <h4 class="mb-2 mb-lg-3">Menu</h4>
        <ul>
          <a href="#"><li>Home</li></a>
          <a href="#"><li>About</li></a>
          <a href="#"><li>Product</li></a>
          <a href="#"><li>Video</li></a>
          <a href="#"><li>Contact</li></a>
          <a href="#"><li>Account</li></a>
        </ul>
      </div>
      <div class="col-3 col-lg-3 px-0 pe-2 pe-lg-0">
        <h4 class="mb-2 mb-lg-3">Product</h4>
        <ul>
          <a href="#"><li>Dress</li></a>
          <a href="#"><li>Traditional Dress</li></a>
          <a href="#"><li>Men's Wear</li></a>
          <a href="#"><li>Women's Wear</li></a>
        </ul>
      </div>
      <div class="col-4 col-lg-3 d-none d-lg-block px-0">
        <h4 class="mb-2 mb-lg-3">Contact</h4>
        <ul>
          <a href="#"><li>Email : test123@gmail.com</li></a>
          <a href="#"><li>Phone : 09253265338</li></a>
        </ul>
      </div>
      <div class="col-4 col-lg-3 d-none d-lg-block px-0">
        <h4 class="mb-2 mb-lg-3">Get in touch</h4>
        <ul>
          <li>Follow us on social media</li>
          <li>
            facebook icon, messenger icon
          </li>
        </ul>
      </div>

      <div class="col-6 d-block d-lg-none px-0">
        <h4 class="mb-2 mb-lg-3">Contact</h4>
        <ul>
          <a href="#"><li>Email : test123@gmail.com</li></a>
          <a href="#"><li>Phone : 09253265338</li></a>
        </ul>
        <h4>Get in touch</h4>
        <ul>
          <li>Follow us on social media</li>
          <li>
            facebook icon, messenger icon
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div>
    <p class="text-center mb-0 mt-2">Copyright @ 2023 Kathit | CREATE BY <a href="https://myanmaronlinetechnology.com/">MOT</a></p>
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