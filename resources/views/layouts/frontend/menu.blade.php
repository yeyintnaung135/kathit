<header class="main-nav container-lg p-0">
  <nav class="d-none d-lg-block py-3">
    <ul class="d-flex justify-content-between align-items-center p-0 mb-0">
        <li class="{{ (request()->is('/')) ? 'active' : '' }} me-3"><a href="{{ url('/') }}">Home</a></li>
        <li class="{{ (request()->is('about')) ? 'active' : '' }} me-3"><a href="{{url('about')}}">About</a></li>
        <li class="{{ (request()->is('products')) ? 'active' : '' }} me-3"><a href="{{url('products')}}">Product</a></li>
        <li class="{{ (request()->is('video')) ? 'active' : '' }} me-3"><a href="{{url('videos')}}">Video</a></li>
        <li>
          <a href="/" class="nav-logo">
            <img src="{{ asset('images/logos/logo.png')}}" alt="" class="logo">
          </a>
        </li>
        <li class="{{ (request()->is('contact')) ? 'active' : '' }} me-3"><a href="{{url('contact')}}">Contact</a></li>
        <li class="{{ (request()->is('account')) ? 'active' : '' }} me-3"><a href="{{url('account')}}">Account</a></li>
        <li class=""><a href="#"><img src="{{ asset('images/icons/search.svg')}}" alt="" class="search"></a></li>
        <li class=""><a href="#"><img src="{{ asset('images/icons/cart.svg')}}" alt="" class="cart"></a></li>
      </ul>
  </nav>
  <nav class="mobile-main-nav d-block d-lg-none p-4">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <div id="menuToggle">
  
          <input type="checkbox" />
          <span></span>
          <span></span>
          <span></span>
        
          <ul id="menu">
            <li>
              <a href="/" class="nav-logo">
                <img src="{{ asset('images/logos/logo.png')}}" alt="" class="logo">
              </a>
            </li>
            <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
            <li class="{{ (request()->is('about')) ? 'active' : '' }}"><a href="{{url('about')}}">About</a></li>
            <li class="{{ (request()->is('products')) ? 'active' : '' }}"><a href="{{url('products')}}">Product</a></li>
            <li class="{{ (request()->is('video')) ? 'active' : '' }}"><a href="{{url('videos')}}">Video</a></li>
            <li class="{{ (request()->is('contact')) ? 'active' : '' }}"><a href="{{url('contact')}}">Contact</a></li>
            <li class="{{ (request()->is('account')) ? 'active' : '' }}"><a href="{{url('account')}}">Account</a></li>
          </ul>
        </div>
        <a href="/"><h3 class="mb-0">KATHIT</h3></a>
      </div>
      <div class="d-flex align-items-center">
        <div class="me-3"><a href="#"><img src="{{ asset('images/icons/search.svg')}}" alt="" class="search"></a></div>
        <div class=""><a href="#"><img src="{{ asset('images/icons/cart.svg')}}" alt="" class="cart"></a></div>
      </div>
    </div>
  </nav>
</header>
@push('styles')
  <style>
    body {
      background: #fff;
    }
    a{
      color: #333;
      text-decoration: none;
    }
    a:hover {
      color: #d32f2f;
    }
    .active a {
      color: #d32f2f !important;
    }
    .main-nav .logo {
      width: 150px;
    }
    .main-nav .search {
      width: 20px;
    }
    .main-nav .cart {
      width: 28px;
    }
    .main-nav li {
      list-style: none;
      font-size: 16px;
    }

    .mobile-main-nav a{
      text-decoration: none;
      color: #d32f2f;
    }

    .mobile-main-nav h3{
      font-size: 26px;
      margin-left: 20px;
      font-weight: 600;
      letter-spacing: 2px;
    }

    #menuToggle
    {
      display: block;
      /* position: relative; */
      /* top: 50px;
      left: 50px; */
      /* z-index: 1; */
      -webkit-user-select: none;
      user-select: none;
      z-index: 9;
    }

    #menuToggle a
    {
      text-decoration: none;
      color: #232323;
      
      transition: color 0.3s ease;
    }

    #menuToggle a:hover
    {
      color: tomato;
    }

    #menuToggle input
    {
      display: block;
      width: 40px;
      height: 32px;
      position: absolute;
      top: 20px;
      left: 20px;
      
      cursor: pointer;
      
      opacity: 0; /* hide this */
      z-index: 2; /* and place it over the hamburger */
      
      -webkit-touch-callout: none;
    }

    #menuToggle span
    {
      display: block;
      width: 33px;
      height: 3px;
      margin-bottom: 6px;
      position: relative;
      
      background: #d32f2f;
      border-radius: 3px;
      
      z-index: 1;
      
      transform-origin: 4px 0px;
      
      transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                  background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                  opacity 0.55s ease;
    }

    #menuToggle span:first-child
    {
      transform-origin: 0% 0%;
    }

    #menuToggle span:nth-last-child(2)
    {
      transform-origin: 0% 100%;
    }

    #menuToggle input:checked ~ span
    {
      opacity: 1;
      transform: rotate(45deg) translate(-2px, -1px);
      background: #232323;
    }

    #menuToggle input:checked ~ span:nth-last-child(3)
    {
      opacity: 0;
      transform: rotate(0deg) scale(0.2, 0.2);
    }

    #menuToggle input:checked ~ span:nth-last-child(2)
    {
      transform: rotate(-45deg) translate(0, -1px);
    }

    #menu
    {
      position: absolute;
      width: 300px;
      top: 0;
      height: 100vh;
      position: fixed;
      margin: 0 0 0 -25px;
      padding: 50px;
      padding-top: 125px;
      background: #ededed;
      list-style-type: none;
      -webkit-font-smoothing: antialiased;
      transform-origin: 0% 0%;
      transform: translate(-109%, 0);
      transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1);
    }

    #menu li
    {
      padding: 10px 0;
      font-size: 22px;
    }

    #menuToggle input:checked ~ ul
    {
      transform: none;
    }
  </style>
@endpush
