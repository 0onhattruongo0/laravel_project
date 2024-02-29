@extends('layouts.backend')
@section('content')
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@if(session('err'))
<div class="alert alert-danger">{{session('err')}}</div>
@endif
<table id="datatables" class='table table-bordered'>
    <thead>
        <tr>
            <th>Học viên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày tạo</th>
            @can('students.edit')
            <th>Kích hoạt khóa học</th>
            @endcan
            @can('students.delete')
            <th>Xóa</th>
            @endcan
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Học viên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày tạo</th>
            @can('students.edit')
            <th>Kích hoạt khóa học</th>
            @endcan
            @can('students.delete')
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
            ajax: "{{route('admin.students.data')}}",
            columns : [
                { data : 'name' },
                { data : 'email' },
                { data : 'phone' },
                { data : 'address' },
                { data : 'created_at' },
                @can('students.edit')
                { data : 'edit' },
                @endcan
                @can('students.delete')
                { data : 'delete' }
                @endcan
            ]
        });
    });
</script>
@endsection