@extends('layouts.site')
@section('title',"trang chu")
@section('maincontent')
   

      
                    <div class="coffee_section layout_padding">
                            <div class="container">
                                <div class="row">
                                <h1 class="coffee_taital">Tat' ca? san? pham?</h1>
                                
                                </div>
                            </div>
         
                            <div class="row">
                            @foreach($list_product as $product)
                           <div class="col-lg-3 col-md-6">
                              <div class="coffee_img">
                              <a href="{{route('site.slug',['slug'=>$product->slug])}}" class="product thump">
                                <img src="{{asset('img/product/'.$product->image)}}" alt="" >
                              </a>
                                </div>
                              <h3 class="types_text"><a href="{{route('site.slug',['slug'=>$product->slug])}}">{{$product->name}}</a></h3>
                              <p class="looking_text">{{$product->price}}</p>
                              <div class="read_bt"><a href="{{route('site.slug',['slug'=>$product->slug])}}">Read More</a></div>
                           </div>
                           @endforeach
                           {!!$list_product->render('frontend.name')!!}
                        </div>
                     
                 
            
                     </div>
      

@endsection