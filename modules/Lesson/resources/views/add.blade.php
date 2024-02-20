@extends('layouts.backend')
@section('content')
<form action="" method="POST" class="">
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
                <label>Học thử</label>
                <select name="is_trial" id="" class="form-select @error('is_trial') is-invalid @enderror">
                    <option value="0" {{old('is_trial' == 0) ? 'selected' : false }} class="">Không</option>
                    <option value="1" {{old('is_trial' == 1) ? 'selected' : false }} class="">Có</option>
                </select>
                @error('is_trial')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label>Sắp xếp:</label>
                <input type="number" id="position" name="position" class="form-control @error('position') is-invalid @enderror" placeholder="Sắp xếp..." value="{{old('position')}}">
                @error('position')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>    
        <div class="col-6">
            <div class="mb-3">
                <label>Video</label>
                <div class="input-group">
                    <input type="text" id="video" name="video" class="form-control @error('video') is-invalid @enderror" placeholder="Video..." value="{{old('video')}}">
                    <button type="button" id="lfm-video" data-input="video" data-preview="holder" class="btn btn-success">Chọn video</button>
                
                    @error('video')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label>Tài liệu</label>
                <div class="input-group">
                    <input type="text" id="document" name="document" class="form-control @error('document') is-invalid @enderror" placeholder="Tài liệu..." value="{{old('document')}}">
                    <button type="button" id="lfm-document" data-input="document" data-preview="holder" class="btn btn-success">Chọn tài liệu</button>
                </div>
                @error('document')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label>Mô tả:</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-select @error('description') is-invalid @enderror" placeholder="Mô tả...">{{old('description')}}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
       
        <div class="">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.lessons.index',$moduleId)}}" class="btn btn-danger">Hủy</a>
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
    .categories_checkbox{
        max-height: 250px;
        overflow: auto
    }
</style>
@endsection

@section('script')
<script>
    CKEDITOR.replace('description', options);
    $('#lfm-video').filemanager('videos');
    $('#lfm-document').filemanager('documents');
</script>
@endsection