@extends('layouts.backend')
@section('content')
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif
<form action="" method="POST">
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th width='20%'>Modules</th>
                <th>Quyền</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($moduleArray))
            @foreach($moduleArray as $key => $item)
            <tr>
                <td>{{ $item['title'] }}</td>
                <td>
                    <div class="row">
    
                        @if(!empty($roleListArr))
                        @foreach($roleListArr as $roleName => $roleLabel)
                            <div class="col-2">
                                <label for="role_{{$item['name']}}_{{$roleName}}">
                                    <input type="checkbox" name='role[{{$item['name']}}][]' id='role_{{$item['name']}}_{{$roleName}}'
                                    {{isRole($roleArr,$item['name'],$roleName) ? 'checked' : false}}
                                    value='{{$roleName}}'>
                                    {{$roleLabel}}
                                </label>
                            </div>
                        @endforeach
                        @endif
                
                        @if($item['name'] == 'groups')
                        <div class="col-2">
                            <label for="role_{{$item['name']}}_pemission">
                                <input type="checkbox" name='role[{{$item['name']}}][]' id='role_{{$item['name']}}_pemission'
                                {{isRole($roleArr,$item['name'],'permission') ? 'checked' : false}}
                                value='permission'>
                                Phân quyền
                            </label>
                        </div>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @csrf
    <button type='submit' class="btn btn-primary">Phân quyền</button>
</form>
@endsection
