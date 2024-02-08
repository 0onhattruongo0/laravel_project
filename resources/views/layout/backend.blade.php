<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
        <link href="{{asset('backend')}}/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        @yield('css')
    </head>
    <body class="sb-nav-fixed">
        @include('backend.parts.header')
        <div id="layoutSidenav">
            @include('backend.parts.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @include('backend.parts.page_title')
                        @yield('content')
                    </div>
                </main>
                @include('backend.parts.footer')
            </div>
        </div>
        <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
        <script src="{{asset('backend')}}/js/scripts.js"></script>
        <script>
            var options = {
              filebrowserImageBrowseUrl: '/filemanager?type=Images',
              filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
              filebrowserBrowseUrl: '/filemanager?type=Files',
              filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            };
          </script>
        @yield('script')
    </body>
</html>
