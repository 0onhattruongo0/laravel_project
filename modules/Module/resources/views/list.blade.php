@extends('layouts.backend')
@section('content')
<p>
<a href="{{route('admin.courses.index')}}" class="btn btn-info mb-3">Quay lại khóa học</a>
<a href="{{route('admin.modules.create',$courseId)}}" class="btn btn-primary mb-3">Thêm mới</a>
</p>
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@if(session('err'))
<div class="alert alert-danger">{{session('err')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Bài giảng</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Bài giảng</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </tfoot>
</table>
@include('backend.delete_form')
@endsection
@section('script')
<script>
    $(document).ready( function () {
        $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('admin.modules.data',$courseId)}}",
            columns : [
                { data : 'name' },
                { data : 'lesson' },
                { data : 'created_at' },
                { data : 'edit' },
                { data : 'delete' }
            ]
        });
    } );
</script>
@endsection