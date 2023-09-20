@extends('layouts.site')
@section('title',"trang chu")
@section('maincontent')
   
<x-slider-show/>
      @foreach($list_category as $category)
        <x-product-home :cat="$category"/>
      @endforeach

@endsection