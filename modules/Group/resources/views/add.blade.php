@extends('layouts.backend')
@section('content')
<form action="{{route('admin.groups.store')}}" method="POST" class="">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label>Tên nhóm</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên nhóm..." value="{{old('name')}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.groups.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</form>
@endsection