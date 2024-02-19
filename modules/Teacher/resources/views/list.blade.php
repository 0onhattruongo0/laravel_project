@extends('layouts.backend')
@section('content')
@can('teachers.add')
<a href="{{route('admin.teachers.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@endcan
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
            @can('teachers.edit')
            <th>Sửa</th>
            @endcan
            @can('teachers.delete')
            <th>Xóa</th>
            @endcan
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên</th>
            <th>Năm kinh nghiệm</th>
            <th>Ngày tạo</th>
            @can('teachers.edit')
            <th>Sửa</th>
            @endcan
            @can('teachers.delete')
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
            ajax: "{{route('admin.teachers.data')}}",
            columns : [
                { data : 'image' },
                { data : 'name' },
                { data : 'exp' },
                { data : 'created_at' },
                @can('teachers.edit')
                { data : 'edit' },
                @endcan
                @can('teachers.delete')
                { data : 'delete' }
                @endcan
            ]
        });
    } );
</script>
@endsection