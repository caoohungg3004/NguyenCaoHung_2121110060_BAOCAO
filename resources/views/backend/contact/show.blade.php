@extends('layouts.admin')
@section('title',$title??'THƯƠNG HIỆU')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CHI TIẾT SẢN PHẨM</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
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
                            <a class=" btn btn-sm btn-primary"  href="{{ route('contact.index') }}"><i class="fas fa-arrow-circle-left"></i> Quay lại</a>
                            <a class=" btn btn-sm btn-danger" href="{{ route('contact.destroy',['contact'=>$contact->id]) }}"> <i class="fa fa-trash"></i>Xóa</a>
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
                            <td>{{ $contact->id }}</td>
                        </tr>
                        <tr>
                            <th>Mã người dùng</th>
                            <td>{{ $contact->user_id }}</td>
                        </tr>
                        <tr>
                            <th>Mã trả lời</th>
                            <td>{{ $contact->replay_id }}</td>
                        </tr>
                        <tr>
                            <th>Tên liên hệ</th>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>SĐT liên hệ</th>
                            <td>{{ $contact->phone }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $contact->title }}</td>
                        </tr>
                        <tr>
                            <th>Sắp xếp</th>
                            <td>{{ $contact->sort_order }}</td>
                        </tr>
                        <tr>
                            <th>Nội dung phản hồi</th>
                            <td>{{ $contact->content }}</td>
                        </tr>
                        <tr>
                            <th>Từ khóa tìm kiếm</th>
                            <td>{{ $contact->metakey }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $contact->metadesc }}</td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $contact->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Người tạo</th>
                            <td>{{ $contact->created_by }}</td>
                        </tr>
                        <tr>
                            <th>Ngày sửa cuối</th>
                            <td>{{ $contact->updated_at }}</td>
                        </tr>
                        <tr>
                            <th>Người sửa cuối</th>
                            <td>{{ $contact->updated_by }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>{{ $contact->status }}</td>
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
                            <a class="btn btn-sm btn-info" href="{{ route('contact.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="{{ route('contact.edit',['contact'=>$contact->id]) }}">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('contact.trash',['contact'=>$contact->id]) }}">
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
