@extends('layouts.frontend.frontend')
@section('title','Kathit | Account')
@section('content')
  <section>
    <div class="account-container p-0 my-5">
      <div class="container">
        <div class="col-12 col-md-8">
            <p class="m-0">Hello <strong>{{ Auth::guard('web')->user()->name }}</strong> (not <strong>{{ Auth::guard('web')->user()->name }}</strong>? <a href="" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();" style="color:#269fb7;">Log out</a>)</p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <br>
            <p>From your account dashboard you can view your <a href="{{ url('/account/orders') }}">recent orders</a>, manage your <a href="{{ url('/account/edit-address') }}">shipping and billing addresses</a>, and <a href="{{ url('/account/edit-account') }}">edit your password and account details</a>.</p>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    
  </script>
@endpush

@push('styles')
  <style>
    
  </style>
@endpush
