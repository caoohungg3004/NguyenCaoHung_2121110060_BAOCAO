@extends('layouts.admin')
@section('title','trang quan tri')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>user</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
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
          <a href="{{ route('user.create') }}" class="btn bg-success"><i class="fa-solid fa-plus"></i> Thêm </a>

        </div>
      </div>
      <div class="card-body">
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
              @foreach ($list_user as $user)
              <td>
                  <input type="checkbox" name="" id="">
              </td>
              <td>{{$user->image}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->slug}}</td>
              <td>
                  <a href="{{route('user.create')}}" class="btn btn-sm btn success">Thêm</a>
                  <a href="{{route('user.show',['user'=>1])}}" class="btn btn-sm btn success">xem</a>
                  <a href="{{route('user.edit',['user'=>1])}}" class="btn btn-sm btn primary">sửa</a>
                  <form action="{{route('user.destroy',['user'=>1])}}" method="POST">
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  </form>

              </td>
              <td>{{$user->id}}</td>
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
