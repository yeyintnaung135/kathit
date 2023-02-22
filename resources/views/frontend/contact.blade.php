@extends('layouts.frontend.frontend')
@section('title','Kathit | Contact')
@push('styles')
  <style>
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
    .email a {
      text-decoration: underline;
      color: #2690fd;
    }
    .contact-form {
      border: 1px solid #3330;
      box-shadow: 0px 0px 7px 1px #d32f2f26;
      border-radius: 5px;
    }
    .contact-form h3{
      color: #d32f2f;
      font-weight: 600;
    }
    .contact-form .greet {
      
    }
    .contact-form input, .contact-form  textarea {
      background: #f7f7f7;
      border: 0;
      padding: 12px 0 12px 30px;
      width: 100%;
      border-radius: 3px;
      resize: none;
    }
    .contact-form button {
      background: #d32f2f;
      color: #fff;
      border: 0;
      width: 100%;
      padding: 12px;
      border-radius: 3px;
    }
    .contact-container .info h4 {
      color: #3d0000;
      font-weight: 600;
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
@section('content')
<x-alert></x-alert>
  <section>
    <div class="sn-contact-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-2 text-center">Contact Us</h3>
            <p class="mb-0 text-center">Get In Touch With Us !</p>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
      <div class="main-banner">
        <img src="{{ url('/images/banners/contact.png') }}" alt="Kathit" class="w-100">
      </div>
    </div>

    <div class="contact-container container my-5">
      <div class="row">
        <div class="col-12 col-lg-6 info text-center text-lg-start">
          <div class="address mx-3 mx-lg-0 mb-4">
            <h4 class="mb-4">Physical Address</h4>
            <div>
              {!! $contact->address !!}
            </div>
          </div>
          <div class="phone mx-3 mx-lg-0 mb-4">
            <h4 class="mb-4 mt-5">Phone Numbers</h4>
            <div>
              {!! $contact->phone !!}
            </div>
          </div>
          <div class="email mx-3 mx-lg-0 mb-4">
            <h4 class="mb-3 mt-5">Email Address</h4>
            <div>
              {!! $contact->email !!}
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="contact-form m-2 ms-lg-5 p-4 p-lg-5">
            <h3 class="text-center mt-3 mt-lg-2">Send Us Message</h3>
            <p class="text-center greet mb-4 mb-lg-4 pb-lg-2">We are here for you! how can we help?</p>
            <form method="post" action="{{url('/contact-message')}}" enctype="multipart/form-data">
            {{-- <form method="post" enctype="multipart/form-data"> --}}
              @csrf
              <div class="mb-3 mb-lg-4">
                <input type="text" name="name" class="" placeholder="Name" required>
              </div>
              <div class="mb-3 mb-lg-4">
                <input type="number" name="phone" class="" placeholder="Phone Number" required>
              </div>
              <div class="mb-3 mb-lg-4">
                <input type="email" name="email" class="" placeholder="Email Address" required>
              </div>
              <div class="mb-3 mb-lg-4">
                <textarea name="message" class="" id="" rows="3" placeholder="Comment or Message" required></textarea>
              </div>
              <button type="submit">SUBMIT</button>
            </form>
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


