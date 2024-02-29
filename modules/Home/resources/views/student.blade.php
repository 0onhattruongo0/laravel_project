@extends('layouts.frontend')
@section('title','Thông tin học viên')
@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="dashboard_container">
                                <div class="dashboard_container_header">
                                    <div class="dashboard_fl_1">
                                        <h4>Thông tin học viên</h4>
                                    </div>
                                </div>
                                <div class="dashboard_container_body p-4">
                                    <!-- Basic info -->
                                    <form action="" method="post">
                                    @csrf
                                    @if(session('msg'))
                                    <h5 class="text-danger">{{ session('msg') }}</h5>
                                    @endif
                                    <div class="submit-section">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Họ tên</label>
                                                <input type="text" name="name" class="form-control" value="{{old('name') ?? $student->name}}">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Điện thoại</label>
                                                <input type="text" name="phone" class="form-control" value="{{old('phone') ?? $student->phone}}">
                                                @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" value="{{$student->email}}" readonly>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label>Mật khẩu mới</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Địa chỉ</label>
                                                <textarea name="address" class="form-control">{!! old('address') ?? $student->address !!}</textarea>
                                                @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <button class="btn btn-theme" type="submit">Cập nhật</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection