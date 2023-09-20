
@extends('layouts.admin')
@section('title','Cập nhật thương hiệu')
@section('content')
<form action="{{ route("brand.update",['brand'=>$brand->id])}}" method="post" enctype="multipart/form-data">
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
              <a href="{{ route('brand.index') }}" class="btn bg-success">
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
                <div class="col-9">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên Thương HIệu</label>
                        <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập vào tên thương hiệu" value="{{ old('name',$brand->name) }}" >
                        @if ($errors->any())
                        <div class="text-danger">
                            {{$errors->first('name')}}
                        </div>

                    @endif
                      </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Từ Khóa</label>
                        <textarea name="metakey" class="form-control" id="exampleFormControlTextarea1" placeholder="Nhập vào từ khóa" value="{{ old('metakey',$brand->metakey) }}"
                            rows="3"></textarea>
                            @if ($errors->any())
                            <div class="text-danger">
                                {{$errors->first('metakey')}}
                            </div>

                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea2" class="form-label">Mô Tả</label>
                        <textarea name="metadesc" class="form-control" id="exampleFormControlTextarea2" placeholder="Nhập vào mô tả" value="{{ old('metadesc',$brand->metadesc) }}"
                            rows="3" ></textarea>
                            @if ($errors->any())
                            <div class="text-danger">
                                {{$errors->first('metadesc')}}
                            </div>

                        @endif
                    </div>
                </div>
                <div class="col-3">

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea2" class="form-label">Sắp Xếp</label>
                        <select name="sort_order" class="form-control" id="select1" aria-label="Default select example">
                <option value="1">
                    chọn thương hiệu
                </option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input name="image" type="file" class="form-control-file" id="inputGroupFile02">
                    </div>
                    <div class="mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Xuất bản</option>
                            <option value="2">Chưa xuất bản</option>


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
