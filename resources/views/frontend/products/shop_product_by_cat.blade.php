@foreach($products as $product)
  <div class="col-6 col-lg-3 mb-2 position-relative">
    <a href="{{url('/product/detail/'.$product->id)}}" class="">
      <div class="img-wrapper">
        <img src="{{ asset($product->getProductPhotos[0]->product_image)}}" alt="" class="product-img">
      </div>
      <h5 class="product-name">{{ $product->name }}</h5>
      <span class="product-price">{{ $product->customize_price ? $product->customize_price : $product->s_price .' MMK to '. $product->xxl_price }} MMK</span>
    </a>
    {{-- <button class="add-to-cart">+</button> --}}
  </div>
@endforeach
<div class="mt-5">
  {!! $products->links() !!}
</div>