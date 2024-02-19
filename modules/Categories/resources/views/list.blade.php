@extends('layouts.backend')
@section('content')
@can('categories.add')
<a href="{{route('admin.categories.create')}}" class="btn btn-primary mb-3">Thêm mới</a>
@endcan
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Link</th>
            <th>Ngày tạo</th>
            @can('categories.edit')
            <th>Sửa</th>
            @endcan
            @can('categories.delete')
            <th>Xóa</th>
            @endcan
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Link</th>
            <th>Ngày tạo</th>
            @can('categories.edit')
            <th>Sửa</th>
            @endcan
            @can('categories.delete')
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
            pageLength:2,
            "bInfo" : false,
            "dom": 'rtip',
            ajax: "{{route('admin.categories.data')}}",
            columns : [
                { data : 'name' },
                { data : 'link' },
                { data : 'created_at' },
                @can('categories.edit')
                { data : 'edit' },
                @endcan
                @can('categories.delete')
                { data : 'delete' },
                @endcan
            ]
        });
    } );
</script>
@endsection