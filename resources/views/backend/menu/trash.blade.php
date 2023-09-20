@extends('layouts.admin')
@section('title','trang quan tri')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Trash menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Thùng rác menu</li>
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

          <a class=" btn  bg-primary" href="{{ route('menu.index') }}"> <i class="fa-solid fa-arrow-left"></i>Quay về</a>
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
                  <th>Mã cấp cha</th>
                  <th>Tên sản phẩm</th>
                  <th>Link</th>
                  <th>Chức năng</th>
                  <th>ID</th>

              </tr>
          </thead>
          <tbody>
              @foreach ($list_menu as $menu)
              <tr>
              <td>
                  <input type="checkbox" name="" id="">
              </td>
              <td>{{$menu->parent_id}}</td>

              <td>{{$menu->name}}</td>
              <td>{{$menu->link}}</td>
              <td>

                <a href="{{route('menu.show',['menu'=>1])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                <a href="{{ route('menu.destroy', ['menu' => $menu->id]) }}"
                    class="btn btn-sm btn-danger" title="delete">
                    <i class="fa-solid fa-trash"></i>
                </a>
                <a href="{{ route('menu.restore', ['menu' => $menu->id]) }}"
                    class="btn btn-sm btn-primary" title="restore">
                    <i class="fa-solid fa-rotate"></i>
                </a>



              </td>
              <td>{{$menu->id}}</td>
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

