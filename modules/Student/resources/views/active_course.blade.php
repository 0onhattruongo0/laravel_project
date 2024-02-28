@extends('layouts.backend')
@section('content')
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@if(session('err'))
<div class="alert alert-danger">{{session('err')}}</div>
@endif
<form action="" method="POST">
    @csrf
    <div class="row mb-2">
        @foreach($ordered as $data)
        <div class="col-12">
            <label for="">
                <input type="checkbox" name='courses[]' value='{{$data->courses->id}}'
                    @foreach($student->orders as $item)
                        @if($item->course_id == $data->courses->id && $item->status == 1)
                        {{'checked';}}
                        @endif
                    @endforeach
                    >
                {{$data->courses->name}}
            </label>
        </div>
        @endforeach
    </div>
    <button type='submit' class="btn btn-primary">Active</button>
    <a href="{{route('admin.students.index')}}" class="btn btn-warning">Hủy</a>
</form>
@endsection