<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codeminifier.com/learnup-2/learnup/home-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Dec 2020 09:57:50 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="author" content="www.frebsite.nl" />
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
    <link href="{{asset('frontend')}}/assets/css/styles.css?ver=2109708511" rel="stylesheet">

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

        @yield('content')

        <!-- ============================ Footer Start ================================== -->

        
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('frontend')}}/assets/js/jquery.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/popper.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/select2.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/slick.js"></script>
    <script src="{{asset('frontend')}}/assets/js/jquery.counterup.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/custom.js"></script>

</body>

</html>