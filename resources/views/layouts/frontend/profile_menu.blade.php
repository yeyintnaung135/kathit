<div class="profile-menu py-4 px-2">
  <h4 class="text-center">{{ Auth::guard('web')->user()->name }}</h4>
  <table class="table border-0 mb-0">
    <tbody class="">
      <tr class="{{ (Request::path() == 'account') ? 'pf-active' : '' }} pf-link">
        <td class="border-0 px-3">
          <a href="{{ url('/account') }}" class="pf-menu">
            <img src="{{ url('/images/icons/profile.svg') }}" alt="" class="pf-icon">
            My Profile
          </a>
        </td>
      </tr>
      <tr class="{{ ((Request::path() == 'account/orders') || (Request::path() == 'account/view-order')) ? 'pf-active' : '' }} pf-link">
        <td class="border-0 px-3">
          <a href="{{ url('/account/orders') }}" class="pf-menu">
            <img src="{{ url('/images/icons/cart.svg') }}" alt="" class="pf-icon">
            Orders
          </a>
        </td>
      </tr>
      <tr class="{{ (Request::path() == 'account/billing-address') ? 'pf-active' : '' }} pf-link">
        <td class="border-0 px-3">
          <a href="{{ url('/account/billing-address') }}" class="pf-menu">
            <img src="{{ url('/images/icons/billing.svg') }}" alt="" class="pf-icon">
            Billing Address
          </a>
        </td>
      </tr>
      <tr class="{{ str_contains(Request::path(), 'account/change-password') ? 'pf-active' : '' }} pf-link">
        <td class="border-0 px-3">
          <a href="{{ url('/account/change-password') }}" class="pf-menu">
            <img src="{{ url('/images/icons/eye.svg') }}" alt="" class="pf-icon">
            Change Password
          </a>
        </td>
      </tr>
      <tr class="pf-link text-center">
        <td class="border-0 px-3"><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">Logout?</a></td>
      </tr>
    </tbody>
  </table> 
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
</div>

@push('styles')
  <style>
    .pf-active a {
      color: #d32f2f !important;
    }
    .profile-menu {
      border: 1px solid #3330;
      box-shadow: 0px 0px 7px 1px #d32f2f26;
      border-radius: 5px;
    }
    .profile-menu a {
      color: #3d0000;
      display: block;
      width: 100%;
    }
    .profile-menu .pf-menu {
      background: #eaca9952;
      padding: 14px 20px;
      border-radius: 4px;
    }
    .pf-icon {
      width: 17px;
      margin-right: 10px;
    }
    .logout {
      font-weight: bold;
      color: #d32f2f !important;
    }
  </style>
@endpush