@extends('layout.backend')
@section('title','Cập nhật khóa học')
@section('content')
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<form action="" method="POST" class="">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{old('name') ?? $course->name}}">
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
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{old('slug')?? $course->slug}}">
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
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Mã khóa học..." value="{{old('code') ?? $course->code}}">
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
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Giá khóa học..." value="{{old('price') ?? $course->price}}">
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
                <input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" placeholder="Giá khuyến mãi..." value="{{old('sale_price') ?? $course->sale_price}}">
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
                    <option value="0" {{old('is_document' == 0) || $course->is_document == 0 ? 'selected' : false }} class="">Không</option>
                    <option value="1" {{old('is_document' == 1) || $course->is_document == 1 ? 'selected' : false }} class="">Có</option>
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
                    <option value="0" {{old('status' == 0) || $course->status == 0 ? 'selected' : false }} class="">Chưa ra mắt</option>
                    <option value="1" {{old('status' == 1) || $course->status == 1 ? 'selected' : false }} class="">Đã ra mắt</option>
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
                <label>Hỗ trợ</label>
                <textarea name="supports" id="supports" class="form-select @error('supports') is-invalid @enderror" placeholder="Hỗ trợ...">{{old('supports') ?? $course->supports}}</textarea>
                @error('supports')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label>Chuyên mục</label>
                <div class="categories_checkbox @error('categories') is-invalid @enderror">
                    {{getCategoriesCheckbox($categories, old('categories') ?? $categoriesId)}}
                </div>
                @error('categories')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label>Nội dung</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-select @error('detail') is-invalid @enderror" placeholder="Nội dung...">{{old('detail') ?? $course->detail}}</textarea>
                @error('detail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        
        <div class="col-12">
            <div class="mb-3">
                <div class="row {{$errors->has('thumbnail') ? 'align-items-center' : 'align-items-end'}}">
                    <div class="col-7">
                        <label>Ảnh đại diện</label>
                        <input type="text" id="thumbnail" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Ảnh đại diện..." value="{{old('thumbnail') ?? $course->thumbnail}}">
                        @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-2 d-grid">
                        <button type="button" id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">Chọn ảnh</button>
                    </div>
                    <div class="col-3">
                        <div id="holder">
                            @if(old('thumbnail') || $course->thumbnail)
                            <img src="{{old('thumbnail') ?? $course->thumbnail}}" alt="" class="">
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
       
        <div class="">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{route('admin.courses.index')}}" class="btn btn-danger">Hủy</a>
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
    #holder img{
        width:100% !important;
        height:auto !important;
    }
    .categories_checkbox{
        max-height: 250px;
        overflow: auto
    }
</style>
@endsection

@section('script')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    CKEDITOR.replace('detail', options);
    $('#lfm').filemanager('image');
</script>
@endsection