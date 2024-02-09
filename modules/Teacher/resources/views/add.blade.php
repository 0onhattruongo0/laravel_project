@extends('layout.backend')
@section('title','Thêm mới giảng viên')
@section('content')
<form action="{{route('admin.teachers.store')}}" method="POST" class="">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" name="name" id="title" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{old('name')}}">
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
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{old('slug')}}">
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label>Năm kinh nghiệm</label>
                <input type="number" name="exp" class="form-control @error('exp') is-invalid @enderror" placeholder="Năm kinh nghiệm..." value="{{old('exp')}}">
                @error('exp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-select @error('description') is-invalid @enderror" placeholder="Mô tả...">{{old('description')}}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="row {{$errors->has('image') ? 'align-items-center' : 'align-items-end'}}">
                    <div class="col-7">
                        <label>Hình ảnh</label>
                        <input type="text" id="image" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Ảnh đại diện..." value="{{old('image')}}">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-2 d-grid">
                        <button type="button" id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">Chọn ảnh</button>
                    </div>
                    <div class="col-3">
                        <div id="holder">
                            @if(old('image'))
                            <img src="{{old('image')}}" alt="" class="">
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        
        <div class="">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.teachers.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</form>
@endsection
@section('css')
<style>
    #holder img{
        width:100% !important;
        height:auto !important;
    }
</style>
@endsection

@section('script')
<script>
    CKEDITOR.replace('description', options);
    $('#lfm').filemanager('image');
</script>
@endsection