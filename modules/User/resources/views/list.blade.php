@extends('layouts.backend')
@section('content')
@can('users.add')
<a href="{{route('admin.users.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@endcan
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@if(session('err'))
<div class="alert alert-danger">{{session('err')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Ngày tạo</th>
            @can('users.edit')
            <th>Sửa</th>
            @endcan
            @can('users.delete')
            <th>Xóa</th>
            @endcan
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Ngày tạo</th>
            @can('users.edit')
            <th>Sửa</th>
            @endcan
            @can('users.delete')
            <th>Xóa</th>
            @endcan
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
                @can('users.edit')
                { data : 'edit' },
                @endcan
                @can('users.delete')
                { data : 'delete' }
                @endcan
            ]
        });
    } );
</script>
@endsection