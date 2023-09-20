<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DANG NHAP HE THONG</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('fontwaresome/css/all.min.css')}}"/>

</head>
<body>
    <div class="khung mt-5">
        <form action="{{ route('admin.postlogin') }}" method="post">
@csrf
            <div class="container p-3">
                <h3 class="text-center text-danger">ĐĂNG NHẬP</h3>
            <div class="mb-3">
                <label for="username">
                    <strong>Tên đăng nhập</strong>
                </label>
                <input type="text" placeholder="Tên đăng nhập hoặc email" name="username" id="username" required
                    class="form-control mt-2">
                    <div class="mb-3">
                        <label for="password">
                            <strong>Mật khẩu(*)</strong>
                        </label>
                        <input type="password" placeholder="Nhập mật khẩu" name="password"
                        id="password" required
                        class="form-control mt-2">
                    </div>
                    <div class="mb-3">
                        <button type="sumbit" class="btn btn-succes form-control">
                            Đăng Nhập
                        </button>
                    </div>
                    <div class="mb-3">

                    </div>
                    </div>
                </form>
            </div>
        </body>
        </html>