@extends('layouts.site')
@section('title',$categoryName)

@section('maincontent')

<section class="maincontent my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <x-categorylist />
                <x-brandlist />
            </div>
            <div class="col-md-9">
                <div class="mx-5 ">
                    <div class="danhmuc" ><span class="fs-5 fw-4 ">{{$categoryName}}</span></div>
                </div>

                <div class="row mb-2 mt-5">
                            <div class="container" >
                            <ul class="products">
                                @foreach ($list_product as $product)

                                <li>
                                    <div class="product-item">
                                        <div class=" product-top">
                                            <div class="card" style="width:100%">
                                                <a href="{{route('site.slug',['slug'=>$product->slug])}}" class="product thump">
                                                    <img src="{{asset('img/product/'.$product->image)}}" alt="" >
                                                </a>
                                                <a href="" class="buy-now">MUA NGAY</a>
                                                </div>
                                                <div class="product-info">

                                                <a href="" class="product-cat">{{$product->category_id}}</a>
                                                <a href="{{route('site.slug',['slug'=>$product->slug])}}" class="product-name">{{$product->name}}</a>
                                                <div class="product-price"><del>{{$product->price}}</del></div>
                                                <div class="product-price">{{$product->price_sale}}</div>
                                                </div>
                                            </div>

                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            </div>

                </div>

                    {{ $list_product->render('frontend.name') }}






        </div>
    </div>
</section>

@endsection