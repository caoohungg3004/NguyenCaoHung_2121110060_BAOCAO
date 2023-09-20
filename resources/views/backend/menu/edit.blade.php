
@extends('layouts.admin')
@section('title','Cập nhật thương hiệu')
@section('content')
<form action="{{ route("menu.update",['menu'=>$menu->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật thương hiệu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cập nhật thương hiệu</li>
            </ol>
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <div class="">
            <button type="submit" class="btn bg-success">
                <i class="fa-solid fa-save"></i> Lưu [Cập nhật] </button>
              <a href="{{ route('menu.index') }}" class="btn bg-success">
                <i class="fa-solid fa-arrow-left"></i> Quay về danh sách </a>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cập nhật thương hiệu</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="name">Tên danh mục</label>
                        <input type="text" name="name" value="{{old('name',$menu->name)}}" id="name" class="form-control" placeholder="Nhập tên danh mục">
                        @if ($errors->any())
                            <div class="text-danger">
                                {{$errors->first('name')}}
                            </div>

                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="type">Chọn kiểu</label>
                        <textarea type="text" name="type" id="type" class="form-control" placeholder="kiểu">{{old('type',$menu->type)}}</textarea>
                        @if ($errors->any())
                            <div class="text-danger">
                                {{$errors->first('type')}}
                            </div>

                        @endif

                    </div>
                    <div class="mb-3">
                        <label for="link">Link</label>
                        <textarea type="text" name="link" id="link" class="form-control" placeholder="Từ khóa tìm kiếm">{{old('link',$menu->link)}}</textarea>
                        @if ($errors->any())
                            <div class="text-danger">
                                {{$errors->first('link')}}
                            </div>

                        @endif

                    </div>
                    <div class="mb-3">
                        <label for="position">position</label>
                        <textarea type="text" name="position" id="position" class="form-control" placeholder="Từ khóa tìm kiếm">{{old('position',$menu->position)}}</textarea>
                        @if ($errors->any())
                            <div class="text-danger">
                                {{$errors->first('position')}}
                            </div>

                        @endif

                    </div>
                </div>
                <div class="col-md-3">

                    <div class="mb-3">
                        <label for="parent_id">Mã cấp cha</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="0">--Chọn mã(0)--</option>
                            <option value="{{old('parent_id',$menu->parent_id)}}">--Mã cũ--</option>
                            {!! $http_parent_id !!}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="table_id">Mã bảng</label>
                        <select name="table_id" id="table_id" class="form-control">
                            <option value="{{old('table_id',$menu->table_id)}}">--Chọn mã(0)--</option>
                            {!! $http_table_id !!}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Xuất bản</option>
                            <option value="0">Chưa xuất bản</option>


                        </select>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
</form>
@endsection
