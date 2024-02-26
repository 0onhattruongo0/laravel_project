@extends('layouts.authStudent')
@section('title','Đăng nhập hệ thống')

@section('content')
<div  id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal" style="border-color: #f0f0f0">

            <div class="modal-body">
                <h5>ĐĂNG NHẬP HỆ THỐNG</h5>
                <div class="login-form">
                    <form action="" method="POST">
                        @csrf
                        @if(session('err'))
                            <p class="text-danger">{{ session('err') }}</p>
                        @endif
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email" required>
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
                            <button type="submit" class="btn btn-md full-width pop-login">Đăng nhập</button>
                        </div>

                        <div class="form-group"><a href="{{route('students.forget_password')}}" style="color: red; font-style: italic">Quên mật khẩu</a></div>
                        <hr>
                        <p class="text-center" style="font-weight: bold;">Nếu bạn chưa có tài khoản? <a href="{{route('students.viewRegister')}}">Đăng ký miễn phí</a></p>
                        
                    </form>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection