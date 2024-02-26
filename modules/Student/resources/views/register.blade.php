@extends('layouts.authStudent')
@section('title','Đăng ký')

@section('content')
<div  id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal" style="border-color: #f0f0f0">

            <div class="modal-body">
                <h5>ĐĂNG KÝ</h5>
                <div class="login-form">
                    <form action="" method="POST">
                        @csrf
                        @if(session('msg'))
                            <p class="text-danger">{{ session('msg') }}</p>
                        @endif

                        <div class="form-group">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tên" required>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                         </div>

                        <div class="form-group">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Email" required>
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                         </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Số điện thoại" required>
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                         </div>

                        <div class="form-group">
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Địa chỉ" required>
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                         </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width pop-login">Đăng ký</button>
                        </div>

                        <hr>
                        <p class="text-center" style="font-weight: bold;">Nếu bạn có tài khoản? <a href="{{route('students.viewLogin')}}">Đăng nhập ngay</a></p>
                        
                    </form>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection