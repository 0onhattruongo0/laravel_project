<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>
        @yield('title')
    </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Custom CSS -->
    <link href="{{asset('frontend')}}/assets/css/styles.css" rel="stylesheet">

    <!-- Custom Color Option -->
    <link href="{{asset('frontend')}}/assets/css/colors.css" rel="stylesheet">
        <link href="{{asset('frontend')}}/assets/css/day.css" rel="stylesheet">
    </head>

<body class="red-skin">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>


    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

    @include('frontend.header')
<!-- End Navigation -->
<div class="clearfix"></div>
<style>
    .trial-video iframe {
        width: 100%;
        height: 400px;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    @media  all and (max-width: 767px) {
        .trial-video iframe {

            height: 200px;
        }
    }

    .education_block_body .price ins {
        font-weight: bold;
        color: #F26650;
    }

    .education_block_body .price del {
        margin-right: 10px;
    }
</style>

@yield('slide')
@yield('content')
              
@include('frontend.footer')
        
    </div>

    <script src="{{asset('frontend')}}/assets/js/jquery.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/popper.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/select2.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/slick.js"></script>
    <script src="{{asset('frontend')}}/assets/js/jquery.counterup.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/custom.js?ver=1904245278"></script>
    {{-- <script src="https://online.unicode.vn/ckeditor/ckeditor.js"></script>
    <script src="https://online.unicode.vn/ckfinder/ckfinder.js"></script> --}}
    <!-- ============================================================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shCore.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shBrushPhp.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/styles/shCore.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/styles/shCoreDefault.min.css"
        rel="stylesheet">
    <script type="text/javascript">
    SyntaxHighlighter.all();
    if (document.getElementById('commentid')) {
         CKEDITOR.replace('commentid', {
            removePlugins: 'elementspath,save,image,flash,iframe,link,smiley,tabletools,find,pagebreak,templates,about,maximize,showblocks,newpage,language'
        });
    }
   
    </script>
        <!-- This page plugins -->
    <!-- ============================================================== -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        </script>
    <script>
    // jQuery(document).ready(function() {
    //     jQuery('.reply').on('click', function() {
    //         var idComment = jQuery(this).data('id');
    //         jQuery('.parent_id').val(idComment);
    //         var formClone = jQuery('.comment-box ').clone();
    //         jQuery('.comment-box ').remove();
    //         jQuery(this).closest('.article_comments_wrap article').append(formClone);
    //         console.log(formClone);
    //     });

    //     if (jQuery('.list-video').length > 0) {
    //         jQuery('.list-video').animate({
    //             scrollTop: $('.lesson-active').offset().top - 200
    //         }, 'fast');
    //     }


    //     var currentPage = jQuery('.bg-light').data('page');
    //     if (typeof currentPage !== undefined && currentPage == 'lession') {
    //         let courseName = jQuery('.bg-light').data('course');
    //         let lessionName = jQuery('.ed_title').text();

    //         if (courseName.trim() != '' && lessionName.trim() != '') {
    

    //             jQuery.ajax({
    //                 url: "https://online.unicode.vn/data/save-history",
    //                 type: 'POST',
    //                 dataType: 'text',
    //                 data: {
    //                     courseName: courseName,
    //                     lessionName: lessionName
    //                 },
    //                 success: function(response) {
    //                     // console.log(response);
    //                 }
    //             });
    //         }
    //     }

    //     jQuery('.lectures_lists_title').on('click', 'a[data-toggle="modal"]', function() {
    //         let courseName = jQuery('.ed_title').text();
    //         let lessionName = jQuery(this).parent().find('a:first').text();

    //         if (courseName.trim() != '' && lessionName.trim() != '') {
               
    //             jQuery.ajax({
    //                 url: "https://online.unicode.vn/data/save-history",
    //                 type: 'POST',
    //                 dataType: 'text',
    //                 data: {
    //                     courseName: courseName,
    //                     lessionName: lessionName
    //                 },
    //                 success: function(response) {
    //                     // console.log(response);
    //                 }
    //             });
    //         }
    //     });

        jQuery('input[name="checklesson"]').on('click', function() {
            var lessonId = $(this).data('lesson');
            var _token = $('input[name="_token"]').val();
            if (lessonId != '') {
                jQuery.ajax({
                    url: "{{route('finish')}}",
                    type: 'POST',
                    data: {
                        lessonId: lessonId,
                        _token: _token
                    },
                    context: this,
                    success: function(response) {
                        if (response.mes == 'addsuccess') {
                            $(this).parent('li').find('a').addClass('checkfinish');
                        } else {
                            $(this).parent('li').find('a').removeClass('checkfinish');
                        }
                    }
                });
            }

        })

    //     jQuery('.status-event img').on('click', function() {
    //         var stautus = $(this).data('status');
         

    //         jQuery.ajax({
    //             url: "https://online.unicode.vn/change-color",
    //             type: 'POST',
    //             data: {
    //                 status: stautus,
    //             },
    //             context: this,
    //             success: function(response) {
    //                 location.reload();
    //             }
    //         });


    //     });

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

    //     const updateActivity = () => {
            

    //         jQuery.ajax({
    //             url: "https://online.unicode.vn/update-activity",
    //             type: 'POST',
    //             dataType: 'text',

    //             success: function(response) {
    //                 //console.log(response);
    //             }
    //         });
    //     }

    //     updateActivity();

    //     setInterval(updateActivity, 60000);
    // })
    // </script>
    
</body>

</html>