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
                <label>Họ Tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Họ Tên..." value="{{old('name') ?? $user->name}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." value="{{old('email') ?? $user->email}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Nhóm</label>
                <select name="group_id" id="" class="form-select @error('group_id') is-invalid @enderror">
                    <option value="0" class="">Chọn nhóm</option>
                    @if($group_list)
                    @foreach($group_list as $item)
                        <option value="{{$item->id}}" {{$item->id == old('group_id') || $user->group_id == $item->id ? 'selected' : false}} class="">{{$item->name}}</option>
                    @endforeach
                @endif
                </select>
                @error('group_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label>Mật khẩu: <span class="text-danger">(Không thay đổi thì không cần nhập)</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu..." value="{{old('password')}}">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{route('admin.users.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</form>
@endsection