@extends('layouts.authStudent')
@section('title','Quên mật khẩu')

@section('content')
<div  id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal" style="border-color: #f0f0f0">

            <div class="modal-body">

                <h5>LẤY LẠI  MẬT KHẨU</h5>
                <p><i>Vui lòng điền email của bạn vào ô bên dưới</i></p>
                <div class="login-form">
                    @if (session('status'))
                        <p class="text-danger">
                            {{ session('status') }}
                        </p>
                    @endif
                    <form action="{{ route('students.email') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Nhập email" required>
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width pop-login">GỬI NGAY</button>
                        </div>

                    </form>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection