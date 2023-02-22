@extends('layouts.frontend.frontend')
@section('title','Kathit | Video')
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
      .founder-bg {
        margin-left: 33px;
      }
    }
  </style>
@endpush
@section('content')
  <section>
    <div class="sn-about-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-2 text-center">Video</h3>
            <p class="mb-0 text-center">Let's Check Our Kathit Video</p>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
    </div>
    <div class="about-container my-5 p-0">
      <div class="container">
        <div class="row gx-1 gx-lg-4 gy-4">
          @foreach ( $videos as $video )
            <div class="col-12 col-md-6 col-lg-4">
              <iframe style="width: 100%;height: 211px;" src="{{ $video->video }}" title="YouTube video player" frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen>
              </iframe>
              <h5 class="mt-1">{{ $video->title }}</h5>
            </div>
          @endforeach 
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    
  </script>
@endpush
