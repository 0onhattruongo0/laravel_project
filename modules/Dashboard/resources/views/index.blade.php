@extends('layouts.backend')
@section('content')
<p>Xin chào, {{Auth::user()->name}}</p>
@endsection