@extends('layouts.admin')
@section('title',$title??'THƯƠNG HIỆU')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CHI TIẾT THƯƠNG HIỆU</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Chi tiết thương hiệu</li>
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

                    </div>
                    <div class="col-md-6 text-right">
                        <div class="text-right">
                            <a class=" btn btn-sm btn-primary"  href="{{ route('topic.index') }}"><i class="fas fa-arrow-circle-left"></i> Quay lại</a>
                            <a class=" btn btn-sm btn-danger" href="{{ route('topic.destroy',['topic'=>$topic->id]) }}"> <i class="fa fa-trash"></i>Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered border-success table-hover ">
                    <thead class="bg-green">
                        <tr class="fs-1">
                            <th width="30%">
                                Tên trường
                            </th>
                            <th>
                                Giá trị
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Id</th>
                            <td>{{ $topic->id }}</td>
                        </tr>

                        <tr>
                            <th>Tên thương hiệu</th>
                            <td>{{ $topic->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $topic->slug }}</td>
                        </tr>
                        <tr>
                            <th>Mã cấp cha</th>
                            <td>{{ $topic->parent_id }}</td>
                        </tr>
                        <tr>
                            <th>Hình đại diện</th>
                            <td class="index-img">
                                <img src="{{ asset('images/topic/'.$topic->image) }}" class="card-img-top index-img" alt="{{ $topic->image }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Từ khóa tìm kiếm</th>
                            <td>{{ $topic->metakey }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $topic->metadesc }}</td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $topic->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Người tạo</th>
                            <td>{{ $topic->created_by }}</td>
                        </tr>
                        <tr>
                            <th>Ngày sửa cuối</th>
                            <td>{{ $topic->updated_at }}</td>
                        </tr>
                        <tr>
                            <th>Người sửa cuối</th>
                            <td>{{ $topic->updated_by }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>{{ $topic->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{-- <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 text-right">
                        <div class="text-right">
                            <a class="btn btn-sm btn-info" href="{{ route('topic.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="{{ route('topic.edit',['topic'=>$topic->id]) }}">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('topic.trash',['topic'=>$topic->id]) }}">
                                <i class=" fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- /.card-footer-->
        </div>
    </section>
  </div>
@endsection
