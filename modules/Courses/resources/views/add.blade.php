@extends('layout.backend')
@section('title','Thêm mới khóa học')
@section('content')
<form action="{{route('admin.courses.store')}}" method="POST" class="">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{old('name')}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{old('slug')}}">
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Giảng viên</label>
                <select name="teacher_id" id="" class="form-select @error('teacher_id') is-invalid @enderror">
                    <option value="0" class="">Chọn giảng viên</option>
                    <option value="1" class="">Admin</option>
                </select>
                @error('teacher_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Mã khóa học</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Mã khóa học..." value="{{old('code')}}">
                @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Giá khóa học</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Giá khóa học..." value="{{old('price')}}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Giá khuyến mãi</label>
                <input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" placeholder="Giá khuyến mãi..." value="{{old('sale_price')}}">
                @error('sale_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Tài liệu đính kèm</label>
                <select name="is_document" id="" class="form-select @error('is_document') is-invalid @enderror">
                    <option value="0" class="">Không</option>
                    <option value="1" class="">Có</option>
                </select>
                @error('is_document')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" id="" class="form-select @error('status') is-invalid @enderror">
                    <option value="0" class="">Chưa ra mắt</option>
                    <option value="1" class="">Đã ra mắt</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label>Nội dung</label>
                <textarea name="detail" id="" cols="30" rows="10" class="form-select @error('detail') is-invalid @enderror" placeholder="Nội dung..."></textarea>
                @error('detail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label>Hỗ trợ</label>
                <textarea name="supports" id="" cols="30" rows="10" class="form-select @error('supports') is-invalid @enderror" placeholder="Hỗ trợ..."></textarea>
                @error('supports')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="row align-items-end">
                    <div class="col-7">
                        <label>Ảnh đại diện</label>
                        <input type="text" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Ảnh đại diện..." value="{{old('thumbnail')}}">
                        @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-2 d-grid">
                        <button type="button" class="btn btn-primary">Chọn ảnh</button>
                    </div>
                    <div class="col-3">
                        <img class="thumbnail" src="https://d1hjkbq40fs2x4.cloudfront.net/2016-01-31/files/1045.jpg" alt="" class="">
                    </div>
                </div>
                
            </div>
        </div>
       
        <div class="">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.users.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</form>
@endsection

@section('css')
<style>
    img.thumbnail{
        width:100%;
        height:auto;
    }
</style>
@endsection