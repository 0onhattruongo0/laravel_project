@extends('layout.backend')
@section('title','Quản lý giảng viên')
@section('content')
<a href="{{route('admin.teachers.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên</th>
            <th>Năm kinh nghiệm</th>
            <th>Ngày tạo</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên</th>
            <th>Năm kinh nghiệm</th>
            <th>Ngày tạo</th>
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
            ajax: "{{route('admin.teachers.data')}}",
            columns : [
                { data : 'image' },
                { data : 'name' },
                { data : 'exp' },
                { data : 'created_at' },
                { data : 'edit' },
                { data : 'delete' }
            ]
        });
    } );
</script>
@endsection