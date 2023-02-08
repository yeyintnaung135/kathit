@extends('layouts.frontend.frontend')
@section('content')
  <section>
    <div class="container-fluid px-3 py-4 px-md-4 py-md-5">
      <div>
        <h1>{{ $data->name }}</h1>
        <p>{{ $data->price }} MMK</p>
        <img src="{{ url($data->product_image) }}" alt="" class="w-25">
        <p>{!! $data->short_desc !!}</p>
        <p>{!! $data->description !!}</p>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script>
    
  </script>
@endpush