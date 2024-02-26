@extends('layouts.authStudent')
@section('title','Đặt lại mật khẩu')

@section('content')
<div  id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal" style="border-color: #f0f0f0">

            <div class="modal-body">

                <h5>Đặt lại mật khẩu</h5>
                <div class="login-form">
                    <form action="{{route('students.password_update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <input type="text" name="email" value='{{ $email ?? old('email') }}' class="form-control" placeholder="Nhập email" required>
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" value='{{ old('password') }}' class="form-control" placeholder="Mật khẩu" required>
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width pop-login">Đặt lại mật khẩu</button>
                        </div>

                    </form>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection