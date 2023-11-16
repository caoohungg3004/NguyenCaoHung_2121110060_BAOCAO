@extends('layouts.site')
@section('title',"trang chu")
@section('maincontent')
   

      
                    <div class="coffee_section layout_padding">
                            <div class="container">
                              <h1 class="coffee_taital mb-5">Tất Cả Sản Phẩm</h1>

                                <div class="row">
                                  <div class="col-md-3">
                                    <x-categorylist/>
                                    <x-brandlist/>
                                    
                                   
                                  </div>
                                  <div class="col">
                                    <div class="row">
                                      @foreach($list_product as $product)
                                     <div class="col-lg-3 col-md-6">
                                        <div class="coffee_img">
                                        <a href="{{route('site.slug',['slug'=>$product->slug])}}" class="product thump">
                                          <img src="{{asset('img/product/'.$product->image)}}" alt="" >
                                        </a>
                                        <a href="" class="buy-now">Mua Ngay</a>
                                          </div>
                                        <h3 class="types_text"><a href="{{route('site.slug',['slug'=>$product->slug])}}">{{$product->name}}</a></h3>
                                        <p class="looking_text fw-bold text-dange">{{number_format("$product->price")}} VNĐ</p>
                                        <div class="read_bt"><a href="{{route('site.slug',['slug'=>$product->slug])}}">Chi Tiết Sản Phẩm</a></div>
                                        <div class="read_bt"><a href="{{route('site.slug',['slug'=>$product->slug])}}"><i class="fa-solid fa-cart-shopping"></i></a></div>

                                      </div>
                                     @endforeach
                                     <div>{{$list_product->links() }}</div>
                                     
                                     {!!$list_product->render('frontend.name')!!}
                                    </div>
                                  </div>
                                
                                
                                </div>
                            </div>
         
                          
                    
                     
                 
            
                     </div>
      

@endsection