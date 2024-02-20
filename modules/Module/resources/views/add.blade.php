@extends('layouts.backend')
@section('content')
<form action="" method="POST" class="">
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
        <div class="">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.modules.index',$courseId)}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</form>
@endsection