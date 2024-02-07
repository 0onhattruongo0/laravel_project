@extends('layout.backend')
@section('title','Quản lý khóa học')
@section('content')
<a href="{{route('admin.courses.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Trạng thái</th>
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
            ajax: "{{route('admin.courses.data')}}",
            columns : [
                { data : 'name' },
                { data : 'price' },
                { data : 'status' },
                { data : 'created_at' },
                { data : 'edit' },
                { data : 'delete' }
            ]
        });
    } );
</script>
@endsection