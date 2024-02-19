@extends('layouts.backend')
@section('content')
<p>
@can('courses')
<a href="{{route('admin.courses.index')}}" class="btn btn-info mb-3">Quay lại khóa học</a>
@endcan
@can('lessons.add')
<a href="{{route('admin.lessons.create',$courseId)}}" class="btn btn-primary mb-3">Thêm mới</a>
@endcan
</p>
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Học thử</th>
            <th>Lượt xem</th>
            <th>Thứ tự</th>
            <th>Thời gian</th>
            @can('lessons.edit')
            <th>Sửa</th>
            @endcan
            @can('lessons.delete')
            <th>Xóa</th>
            @endcan
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Học thử</th>
            <th>Lượt xem</th>
            <th>Thứ tự</th>
            <th>Thời gian</th>
            @can('lessons.edit')
            <th>Sửa</th>
            @endcan
            @can('lessons.delete')
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
            ajax: "{{route('admin.lessons.data',$courseId)}}",
            columns : [
                { data : 'name' },
                { data : 'is_trial' },
                { data : 'views' },
                { data : 'position' },
                { data : 'created_at' },
                @can('lessons.edit')
                { data : 'edit' },
                @endcan
                @can('lessons.delete')
                { data : 'delete' }
                @endcan
            ]
        });
    } );
</script>
@endsection