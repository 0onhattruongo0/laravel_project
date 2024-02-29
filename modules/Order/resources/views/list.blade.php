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
            <th>Khóa học</th>
            <th>Trạng thái</th>
            <th>Ngày mua</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Học viên</th>
            <th>Khóa học</th>
            <th>Trạng thái</th>
            <th>Ngày mua</th>
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
            ajax: "{{route('admin.orders.data')}}",
            columns : [
                { data : 'name' },
                { data : 'course' },
                { data : 'status' },
                { data : 'created_at' },
                { data : 'delete' }
            ]
        });
    });
</script>
@endsection