@extends('layouts.frontend.frontend')
@section('title','Kathit | Products')
@section('content')
<x-alert></x-alert>
  <section>
    <div class="sn-products-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-2 text-center">Products</h3>
            <p class="mb-0 text-center">Let's First Window Shopping & GRAB your loved ones</p>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
    </div>

    <div class="products-container container my-5">
      <div class="d-flex justify-content-between mb-5">
        <div class=""></div>
        <div class="sortwrap">
          <select name="" class="orderby" aria-label="Shop Order" id="sort_id">
            <option hidden selected>Sort By</option>
            {{-- <option value="1">Sort by Popularity</option> --}}
            <option value="2">Sort by Latest</option>
            <option value="3">Sort by price:low to high</option>
            <option value="4">Sort by price:high to low</option>
          </select>
        </div>
      </div>
      <div class="row gx-3 gy-3 gx-lg-3 gy-lg-4" id="product_space">
        @include('frontend/shop_product')
      </div>
      <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      function fetch_data(page, sort_type)
       {
        // alert("Sort Type = "+sort_type);
        $.ajax({
         url:"/shoppagination/fetch_data?page="+page+"&sorttype="+sort_type,
         success:function(data)
         {
          console.log(data);
          $('#product_space').html('');
          $('#product_space').html(data);
        //   $('.pagination').hide();
         }
        })
       }
       $(document).on('change', '#sort_id', function(){
        // alert("hello");
        var page = $('#hidden_page').val();
        var sort_type = $('#sort_id').val();
        // alert(page);
        fetch_data(page, sort_type);
       });
       $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        // alert(page);
        $('#hidden_page').val(page);
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#sort_id').val();


        $('li').removeClass('active');
              $(this).parent().addClass('active');
              fetch_data(page, sort_type);
       });

    })
  </script>
@endpush

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
    .products-container .img-wrapper {
      background: #eaca9952;
    }
    .products-container a:hover {
      color: #333;
    }

    .products-container .product-img {
      width: 100%;
      aspect-ratio: 1/1;
      object-fit: cover;
    }
    .products-container .img-wrapper {
      background: #eaca9952;
    }
    .products-container .product-name {
      margin-top: 18px;
      font-weight: 600;
      font-size: 18px;
    }
    .products-container .product-price {
      color: #d32f2f;
      font-weight: 600;
      font-size: 15px;
    }
    .add-to-cart {
      background: none;
      border: 1px solid #d32f2f;
      color: #d32f2f;
      font-size: 40px;
      width: 30px;
      height: 30px;
      padding-bottom: 5px;
      align-items: center;
      display: flex;
      justify-content: center;
      border-radius: 50px;
      position: absolute;
      right: 5%;
      bottom: 2%;
    }
    .add-to-cart:hover {
      background: #d32f2f;
      color: #fff;
      border: 1px solid #d32f2f;
    }
    .pagination {
      float: right;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .pagination li {
      margin-left: 3px;
      margin-top: 5px;
    }
    .pagination span, .pagination .page-item .page-link {
      border: 2px solid #d32f2f82;
      border-radius: 0 !important;
      color: #d32f2f82;
    }
    .pagination .page-item .page-link:hover {
      background: #d32f2f82;
      color: #fff;
    }
    
    .pagination .active .page-link {
      background: #d32f2f !important;
      color: #fff;
    }
    .sortwrap {
      border: 1px solid #333;
      border-radius: 3px;
      padding: 0px 10px;
    }
    #sort_id {
      background: none;
      border: none;
      outline: none;
      padding: 8px 0;
    }
    
    /* .add-to-cart img {
      width: 30px;
    } */
    @media screen and (min-width: 600px) {
      .pagination li {
        margin-right: 20px;
      }
    }
  </style>
@endpush
