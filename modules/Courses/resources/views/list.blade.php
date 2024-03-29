@extends('layouts.backend')
@section('content')
@can('courses.add')
<a href="{{route('admin.courses.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@endcan
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Modules</th>
            <th>Ngày tạo</th>
            @can('courses.edit')
            <th>Sửa</th>
            @endcan
            @can('courses.delete')
            <th>Xóa</th>
            @endcan
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Modules</th>
            <th>Ngày tạo</th>
            @can('courses.edit')
            <th>Sửa</th>
            @endcan
            @can('courses.delete')
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
            ajax: "{{route('admin.courses.data')}}",
            columns : [
                { data : 'name' },
                { data : 'price' },
                { data : 'status' },
                { data : 'modules' },
                { data : 'created_at' },
                @can('courses.edit')
                { data : 'edit' },
                @endcan
                @can('courses.delete')
                { data : 'delete' }
                @endcan
            ]
        });
    } );
</script>
@endsection