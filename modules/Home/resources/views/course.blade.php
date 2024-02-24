@extends('layouts.frontend')
@section('content')

                    
               
<div class="ed_detail_head">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12">
                <div class="ed_detail_wrap">
                    <div class="ed_header_caption">
                        <h2 class="ed_title">{{$course->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->
<!-- ============================ Course Detail ================================== -->
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <!-- Overview -->
                <div class="edu_wraper">
                    <h4 class="edu_title">Mô tả</h4>
                    {!!$course->detail!!}
                </div>
                <div class="edu_wraper">
                    <h4 class="edu_title">Bài học</h4>
                    <div id="accordionExample" class="accordion shadow circullum">
                        @foreach($course->module as $module)
                        <div class="card">
                            <div id="heading0" class="card-header bg-white shadow-sm border-0">
                                <h6 class="mb-0 accordion_title">
                                    <a href="fddsfd" data-toggle="collapse" data-target="#collapse0" aria-expanded="false" aria-controls="collapse0" class="d-block position-relative collapsed text-dark collapsible-link py-2">{{$module->name}}</a>
                                </h6>
                            </div>
                            <div id="collapse0" aria-labelledby="heading0" data-parent="#accordionExample" class="collapse show">
                                <div class="card-body pl-3 pr-3">
                                    <ul class="lectures_lists">
                                        @foreach($module->lesson as $lesson)
                                        <li>
                                            <div class="lectures_lists_title">
                                                <a href="{{route('lesson',$lesson->slug)}}">
                                                    <i class="ti-control-play"></i>
                                                    {{$lesson->name}}
                                                </a>
                                            </div>
                                        </li>
                                        @endforeach
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="edu_wraper" style="padding: 5px;">
                    <p>
                        <img src="{{$course->thumbnail}}" alt="">
                    </p>
                    <h4 class="text-center text-danger">{{number_format($course->sale_price) . 'đ'}}</h4>
                    <p>Giảng viên: {{$course->teacher->name}}</p>
                    <p>Học trên mọi thiết bị</p>
                    <p>Không giới hạn thời gian</p>
                    <p class="text-center">
                        <a href="/bai-hoc/bai-01-gioi-thieu-laravel-framework-cai-dat-laravel-8x" class="btn btn-danger btn-block" style="color: #fff;">Vào học
                        ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
  

@endsection