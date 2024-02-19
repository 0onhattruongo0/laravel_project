@extends('layouts.backend')
@section('content')
@can('groups.add')
<a href="{{route('admin.groups.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@endcan
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Người tạo</th>
            @can('groups.permission')
            <th>Phân quyền</th>
            @endcan
            @can('groups.edit')
            <th>Sửa</th>
            @endcan
            @can('groups.delete')
            <th>Xóa</th>
            @endcan
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Người tạo</th>
            @can('groups.permissions')
            <th>Phân quyền</th>
            @endcan
            @can('groups.edit')
            <th>Sửa</th>
            @endcan
            @can('groups.delete')
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
            ajax: "{{route('admin.groups.data')}}",
            columns : [
                { data : 'name' },
                { data : 'user_id' },
                @can('groups.permission')
                { data : 'permissions' },
                @endcan
                @can('groups.edit')
                { data : 'edit' },
                @endcan
                @can('groups.delete')
                { data : 'delete' }
                @endcan
            ]
        });
    } );
</script>
@endsection