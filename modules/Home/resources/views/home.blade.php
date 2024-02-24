@extends('layouts.frontend')
@section('slide')
<div class="main-slide owl-carousel owl-theme">
    <div class="item">
        <img src="{{asset('frontend/assets/img/unicode-online.jpg')}}" alt="">
    </div>
</div>
@endsection

@section('content')
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

                    <div class="singles_items">
                        <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                                <a href="#first_video_modal" data-toggle="modal"><img src="https://vcdn-vnexpress.vnecdn.net/2020/05/06/546-1586955437-2173-1587007302-9641-1588750107.png" class="img-fluid custom-course-image" style="height: 190px; width: 100%; object-fit: cover;" alt=""></a>

                            </div>

                            <div class="education_block_body">
                                <h4 class="bl-title"><a href="#first_video_modal" data-toggle="modal">Hướng dẫn
                                        học lập
                                        trình Online hiệu quả</a></h4>
                            </div>



                            <div class="education_block_footer">
                                <div class="education_block_author">
                                    <div class="path-img"><img src="/frontend/assets/img/ta-hoang-an.jpg" class="img-fluid " alt=""></div>
                                    <h5><a>Hoàng An</a></h5>
                                </div>

                                <div class="foot_lecture" style="background: #CD3518; color: #fff;">Hãy xem
                                    trước khi
                                    học</div>
                            </div>
                        </div>
                    </div>

                                        <!-- Single Slide -->
                    <div class="singles_items">
                        <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                                <a href="/khoa-hoc/lap-trinh-web-php-mysql-voi-laravel-framework"><img src="/storage/images/khoa%20hoc%20laravel.png" class="img-fluid custom-course-image" alt=""></a>

                            </div>

                            <div class="education_block_body">
                                <h4 class="bl-title"><a href="/khoa-hoc/lap-trinh-web-php-mysql-voi-laravel-framework">Lập trình web PHP &amp; MySQL với Laravel Framework</a>
                                </h4>
                            </div>



                            <div class="education_block_footer">
                                <div class="education_block_author">
                                    <div class="path-img"><img src="/frontend/assets/img/ta-hoang-an.jpg" class="img-fluid " alt=""></div>
                                    <h5><a>Hoàng An</a></h5>
                                </div>
                                <div class="foot_lecture"><i class="ti-control-skip-forward mr-2"></i>262
                                    bài học
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Slide -->
                    
                </div>
                            </div>

            <div class="modal fade" id="first_video_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 800px;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                Hướng dẫn học lập trình Online hiệu quả
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body trial-video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/TbWFLqudtj8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

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