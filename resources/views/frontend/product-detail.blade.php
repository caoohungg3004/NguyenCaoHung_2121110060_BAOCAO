@extends('layouts.site')
@section('title','Trang chủ')

@section('maincontent')

<div class="row clear-fix mt-5 ms-1">
  <div class="col-6">
    <div><img class="img-fluid" src="{{asset('img/product/'.$product->image)}}" alt="{{$product->image}}"></div>
  </div>
<div class="col-6 bg-eeeeee product-detail">
    <div class="row">
      <div class="col-md-12">
        <h4 class="mt-5">{{$product->name}}</h4>
        <div class="price mb-5">
          <h2 class="orangepv"><del>{{$product->price}}VND</del></h2>
        </div>
        <div class="price mb-5">
            <h2 class="red">{{$product->price_sale}}99.000 VND</h2>
          </div>
        <p class="mota"> {{$product->detail}}</p>
        <input type="number" id="qty" name="qty" value="1" min="1" class="text-center qty">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="cart-detail">
          <a href=""><input type="button" value="Thêm vào giỏ hàng" name="ADDCART" id="ADDCART"></a>
        </div>
        <div class="product-contact">
          <span>Gọi đặt mua: <a class="textdecor-none orangepv" href="#">19006750</a> (Miễn phí)</span>
          <p>Mở cửa 8h -21h cả Thứ 7, Chủ Nhật</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row clear-fix mt-5 ms-1">
    Sản phẩm nổi bật
</div>
    {{-- slider --}}
    {{-- ưu đãi --}}




@endsection