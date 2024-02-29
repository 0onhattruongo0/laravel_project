@extends('layouts.frontend')
@section('title','Trang chủ')
@section('slide')
<div class="main-slide owl-carousel owl-theme">
    <div class="item">
        <img src="{{asset('frontend/assets/img/unicode-online.jpg')}}" alt="">
    </div>
</div>
@endsection

@section('content')
@if($myCourse)
@if($myCourse->count()>0)
<section>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 mb-3">
                <div class="sec-heading2">
                    <div class="sec-left">
                        <h2>Khóa học của tôi</h2>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                <div class="arrow_slide three_slide">
                   <!-- Single Slide -->
                   @foreach($myCourse as $item)
                    <div class="singles_items">
                        <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                                <a href="{{route('course',$item->courses->slug)}}"><img src="{{$item->courses->thumbnail}}" class="img-fluid custom-course-image" alt=""></a>

                            </div>

                            <div class="education_block_body">
                                <h4 class="bl-title"><a href="{{route('course',$item->courses->slug)}}">{{$item->courses->name}}</a>
                                </h4>
                            </div>



                            <div class="education_block_footer">
                                <div class="education_block_author">
                                    <div class="path-img"><img src="{{$item->courses->teacher->image}}" class="img-fluid " alt=""></div>
                                    <h5><a>{{$item->courses->teacher->name}}</a></h5>
                                </div>
                                <div class="foot_lecture"><i class="ti-control-skip-forward mr-2"></i>{{$item->courses->lesson->count()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Single Slide -->
                    
                </div>
            </div>

        </div>

    </div>
</section>
@endif
@endif

<section class="bg-light">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 mb-3">
                <div class="sec-heading2">
                    <div class="sec-left">
                        <h2>Danh sách khóa học</h2>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            @foreach($courses as $course)
            <div class="col-lg-4 col-md-6">
                <div class="education_block_grid style_2" style="">

                    <div class="education_block_thumb n-shadow">
                        <a href="{{route('course',$course->slug)}}"><img src="{{$course->thumbnail}}" class="img-fluid custom-course-image" alt=""></a>
                        <div class="cources_price" style="left: 0; top: 0; background: #f26651db; box-shadow: 0px 0px 0px 4px #06833dab; color: #fff;">
                            {{number_format($course->sale_price) . 'đ'}}
                        </div>
                        <div class="cources_price" style="left: auto;right: 0px !important; top: 0px; background: #f26651db; box-shadow: 0px 0px 0px 4px #06833dab; color: #fff;">
                            {{$course->status == 1 ? 'Đã ra mắt' : 'Chưa ra mắt'}}
                        </div>
                    </div>

                    <div class="education_block_body">
                        <h4 class="bl-title"><a href="{{route('course',$course->slug)}}">{{$course->name}}</a>
                        </h4>
                        <p class="price">
                            <del>{{number_format($course->price) . 'đ'}}</del>
                            <ins>{{number_format($course->sale_price) . 'đ'}}</ins>
                        </p>
                    </div>

                    <div class="education_block_footer">
                        <div class="education_block_author">
                            <div class="path-img"><a href="instructor-detail.html"><img src="{{$course->teacher->image}}" class="img-fluid " alt=""></a></div>
                            <h5><a href="#">{{$course->teacher->name}}</a></h5>
                        </div>
                        <div class="foot_lecture"><i class="ti-control-skip-forward mr-2"></i>{{($course->lesson->count())}} bài học
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection