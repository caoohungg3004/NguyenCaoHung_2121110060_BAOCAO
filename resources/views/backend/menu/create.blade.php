@extends('layouts.admin')
@section('title','Thêm thương hiệu')
@section('content')
<form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add menu</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Thêm thương hiệu</li>
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
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm btn-danger">
                            <i class="fa fa-trash">Xóa</i>
                        </button>
                    </div>

                    <div class="col-md-6 text-right">
                      <button type="submit" class="btn bg-success">
                        <i class="fa-solid fa-save"></i> Lưu [Thêm] </button>
                      <a href="{{ route('menu.index') }}" class="btn bg-success">
                        <i class="fa-solid fa-arrow-left"></i> Quay về danh sách </a>

                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label for="name">Tên danh mục</label>
                            <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" placeholder="Nhập tên danh mục">
                            @if ($errors->any())
                                <div class="text-danger">
                                    {{$errors->first('name')}}
                                </div>

                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="type">Chọn kiểu</label>
                            <textarea type="text" name="type" id="type" class="form-control" placeholder="kiểu">{{old('type')}}</textarea>
                            @if ($errors->any())
                                <div class="text-danger">
                                    {{$errors->first('type')}}
                                </div>

                            @endif

                        </div>
                        <div class="mb-3">
                            <label for="link">Link</label>
                            <textarea type="text" name="link" id="link" class="form-control" placeholder="Từ khóa tìm kiếm">{{old('link')}}</textarea>
                            @if ($errors->any())
                                <div class="text-danger">
                                    {{$errors->first('link')}}
                                </div>

                            @endif

                        </div>
                        <div class="mb-3">
                            <label for="position">position</label>
                            <textarea type="text" name="position" id="position" class="form-control" placeholder="Từ khóa tìm kiếm">{{old('position')}}</textarea>
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
                                {!! $http_parent_id !!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="table_id">Mã bảng</label>
                            <select name="table_id" id="table_id" class="form-control">
                                <option value="0">--Chọn mã(0)--</option>
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
