@extends('layouts.backend')
@section('content')
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<form action="" method="POST" class="">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label>Tên</label>
                <input type="text" name="name" id="title" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{old('name') ?? $category->name}}">
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
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{old('slug') ?? $category->slug}}">
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Nhóm</label>
                <select name="parent_id" id="" class="form-select @error('parent_id') is-invalid @enderror">
                    <option value="0" class="">Không</option>
                    {{getCategories($categories,old('parent_id') ?? $category->parent_id)}}
                </select>
                @error('parent_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</form>
@endsection