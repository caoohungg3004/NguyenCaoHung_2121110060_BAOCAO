@extends('layouts.admin')
@section('title','trang quan tri')
@section('content')

<form method="post" enctype="multipart/form-data">
    @csrf
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>menu</h1>
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
          <a href="{{ route('menu.create') }}" class="btn bg-success"><i class="fa-solid fa-plus"></i> Thêm </a>
          <a class=" btn  bg-danger" href="{{ route('menu.trash') }}"> <i class="fa fa-trash"></i>Thùng Rác</a>
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
        <table class="table table-bordered" id="myTable">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Mã cấp cha</th>
                  <th>Tên sản phẩm</th>
                  <th>link</th>
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
                <a class="btn btn-sm btn-success" href="{{ route('menu.show',['menu'=>$menu->id]) }}"><i class="fa fa-eye"></i></a>

                  <a href="{{route('menu.edit',['menu'=>$menu->id])}}" class="btn btn-sm btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                  {{-- <form class="btn btn-sm " action="{{ route('menu.destroy',['menu'=>$menu->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form> --}}
                <a href="{{ route('menu.delete', ['menu' => $menu->id]) }}"
                    class="btn btn-sm btn-danger" title="delete">
                    <i class="fa-solid fa-trash"></i>
                </a>
                @if ($menu->status==1)
                <a href="{{route('menu.status',['menu'=>$menu->id])}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-toggle-on"></i>
                </a>

                @else
                <a href="{{route('menu.status',['menu'=>$menu->id])}}" class="btn btn-sm btn-danger">
                    <i class="fas fa-toggle-off"></i>
                </a>
                @endif

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
</form>
@endsection

