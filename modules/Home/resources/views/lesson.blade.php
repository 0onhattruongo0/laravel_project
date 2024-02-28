@extends('layouts.frontend')
@section('title')
{{$lesson->name}}
@endsection
@section('content')
<section class="bg-light" data-page="lession" data-course="Lập trình web PHP &amp; MySQL với Laravel Framework">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="edu_wraper">
                <div class="row">
                    <div class="col-lg-9 col-md-9 box-video">
                        <h3 class="ed_title">{{$lesson->name}}</h3>
                        <hr>
                        <iframe class='sproutvideo-player' src='{{$lesson->video->url}}' width='630' height='394' frameborder='0' allowfullscreen></iframe>
                        <hr>
                        
                        <div class="box-action-lesson">
                            @if($more)
                            <a href="{{$more ? route('lesson', $more->slug) : false}}" class="next-lesson">
                                Bài tiếp <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </a>
                            @else
                            <div class="next-lesson"></div>
                            @endif
                            <a style="margin-left: 10px; color: #fff;" href="#" class="btn hide-lesson">Ẩn bài học</a>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-3 col-md-3 sidebar">
                        <form action="" class="">
                            @csrf
                        <ul class="list-video">
                            @if($course)    
                            @foreach($course->module as $module)
                            <li>
                                <p>{{$module->name}}</p>
                                <ul>
                                    @foreach($module->lesson as $lesson)
                                    <li class="{{url()->current() == route('lesson',$lesson->slug) ? 'lesson-active' : false}}">
                                        <input name="checklesson" type="checkbox" data-course="{{$course->id}}" data-lesson="{{$lesson->id}}" {{checkFinish($arrFinish, $course->id, $lesson->id) ? 'checked' : false}}/>
                                        <a href="{{route('lesson',$lesson->slug)}}" class="{{checkFinish($arrFinish, $course->id, $lesson->id) ? 'checkfinish' : false}}">{{$lesson->name}}</a>
                                    </li>
                                    @endforeach
                                    {{-- <li class="">
                                        <input name="checklesson" type="checkbox" data-course="14" data-lesson="249" checked/>
                                        <a href="/bai-hoc/bai-02-cau-truc-thu-muc-va-luong-request-trong-laravel-framework" class=" checkfinish ">Bài 02: Cấu trúc thư mục và luồng Request trong Laravel Framework</a>
                                    </li>
                                    <li class="">
                                        <input name="checklesson" type="checkbox" data-course="14" data-lesson="250" checked/>
                                        <a href="/bai-hoc/bai-03-thiet-lap-cau-hinh-can-thiet-cho-laravel" class=" checkfinish ">Bài 03: Thiết lập cấu hình cần thiết cho Laravel</a>
                                    </li> --}}
                                </ul>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Overview -->
            
        </div>
        <!-- Sidebar -->
    </div>
</div>
</section>
@endsection

@section('custom_js')
<script>
    jQuery('input[name="checklesson"]').on('click', function() {
        var lessonId = $(this).data('lesson');
        var courseId = $(this).data('course');
        var _token = $('input[name="_token"]').val();
        if (lessonId != '') {
            jQuery.ajax({
                url: "{{route('finish')}}",
                type: 'POST',
                data: {
                    lessonId: lessonId,
                    courseId: courseId,
                    _token: _token
                },
                context: this,
                success: function(response) {
                    console.log(response.mes);
                    if (response.mes == 'addsuccess') {
                        $(this).parent('li').find('a').addClass('checkfinish');
                    } else {
                        $(this).parent('li').find('a').removeClass('checkfinish');
                    }
                }
            });
        }

    })

    if (jQuery('.hide-lesson').length > 0) {
        jQuery('.hide-lesson').on('click', function(e) {
            e.preventDefault();
            if (!jQuery('.edu_wraper').hasClass('full-width')) {
                jQuery('.edu_wraper').addClass('full-width');
                jQuery(this).text('Hiện bài học');
            } else {
                jQuery('.edu_wraper').removeClass('full-width');
                jQuery(this).text('Ẩn bài học');
            }
        });
    }

</script>
@endsection
