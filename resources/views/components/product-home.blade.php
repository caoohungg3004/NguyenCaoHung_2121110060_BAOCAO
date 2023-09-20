<div class="coffee_section layout_padding">
         <div class="container">
            <div class="row">
               <h1 class="coffee_taital">{{$category->name}}</h1>
               <div class="bulit_icon"><img src="{{asset('img/category/'.$category->image)}}"></div>
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
                        </div>
                     
                 
            
         </div>

         

         
<!-- <div class="headline">
    <h3>{{$category->name}}</h3>
  </div>

  <ul class="products">
    @foreach ($list_product as $product)

    {{-- @php
    $product_image= $product->productimg;
    $img="";
    if (count($product_image)>0) {
        $img=$product_image[0]["image"];
    }
    @endphp --}}
    <li>
        <div class="product-item">
            <div class="product-top">
              <a href="" class="product-thumb">
                <img src="{{asset('img/product/'.$product->image)}}" alt="" >
              </a>
            </div>
            <div class="product-info">

              <a href="" class="product-cat">{{$product->category_id}}</a>
              <a href="" class="product-name">{{$product->name}}</a>
              <div class="product-price"><del>{{$product->price}}</del></div>
              <div class="product-price">{{$product->price_sale}}</div>
            </div>
        </div>
    </li>
    @endforeach

    

</ul> -->