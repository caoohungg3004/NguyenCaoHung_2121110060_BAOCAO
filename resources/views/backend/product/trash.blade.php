@extends('layouts.admin')
@section('title','trang quan tri')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Trash product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Thùng rác product</li>
          </ol>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Title</h3>

        <div class="card-tools">

          <a class=" btn  bg-primary" href="{{ route('product.index') }}"> <i class="fa-solid fa-arrow-left"></i>Quay về</a>
        </div>
      </div>
      <div class="card-body">
        @if (session('message'))
          @php
          $message=session('message');
        @endphp
<div class="alert alert-{{ $message['type'] }}">
{{ $message['mgs'] }}
</div>
@endif
        <table class="table table-bordered">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Hình ảnh</th>
                  <th>Tên sản phẩm</th>
                  <th>slug sản phẩm</th>
                  <th>Chức năng</th>
                  <th>ID</th>

              </tr>
          </thead>
          <tbody>
              @foreach ($list_product as $product)
              <tr>
              <td>
                  <input type="checkbox" name="" id="">
              </td>
              <td> <img width="50px" height="50px" src="{{asset('img/product/'.$product->image) }}" alt=""> </td>
              <td>{{$product->name}}</td>
              <td>{{$product->slug}}</td>
              <td>

                <a href="{{route('product.show',['product'=>1])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                <a href="{{ route('product.destroy', ['product' => $product->id]) }}"
                    class="btn btn-sm btn-danger" title="delete">
                    <i class="fa-solid fa-trash"></i>
                </a>
                <a href="{{ route('product.restore', ['product' => $product->id]) }}"
                    class="btn btn-sm btn-primary" title="restore">
                    <i class="fa-solid fa-rotate"></i>
                </a>



              </td>
              <td>{{$product->id}}</td>
            </tr>
              @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

@endsection

