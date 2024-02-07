@extends('layout.backend')
@section('title','Danh sách người dùng')
@section('content')
<a href="{{route('admin.users.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Ngày tạo</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
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
            ajax: "{{route('admin.users.data')}}",
            columns : [
                { data : 'name' },
                { data : 'email' },
                { data : 'group_id' },
                { data : 'created_at' },
                { data : 'edit' },
                { data : 'delete' }
            ]
        });
    } );
</script>
@endsection