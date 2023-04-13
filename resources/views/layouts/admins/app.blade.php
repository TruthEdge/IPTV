<!DOCTYPE html>
<html lang="ar"  dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" href="{{asset('dashboard/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/images/favicon.png')}}" type="image/x-icon">
    <title>{{($setting = \App\Models\Setting::where('name',"site_name")->first()) ? $setting->value : env('APP_NAME')}}- Admin </title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- tags input-->

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/prism.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('dashboard/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/responsive.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/animate.css')}}">

    <!-- latest jquery-->
    <script src="{{asset('dashboard/js/jquery-3.5.1.min.js')}}"></script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6-TPNTTCKHAbyscTEeDRgTT7KcEraVek="></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css"/>
    <!-- tags input-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>


    @livewireStyles

    @yield('css_code')
</head>

{{--@if(auth()->check())--}}

    <body class="ltr">

    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">

        <!-- Page Header Start-->
         @auth
            @include('layouts.admins.header')
         @endauth


        <!-- Page Body Start-->

        <div class="page-body-wrapper horizontal-menu">

            <!-- Page Sidebar Start-->
        @auth
           @livewire('admin.layouts.sidebar')
        @endauth
            <!-- Page Sidebar Ends-->


            <div class="@if(auth()->check()) page-body @endif">

                @yield('content')

                {{ isset($slot) ? $slot : null }}

            </div>

            <!-- footer start-->

            @auth
                @include('layouts.admins.footer')
            @endauth


        </div>
    </div>

    <!-- feather icon js-->
    <script src="{{asset('dashboard/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('dashboard/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('dashboard/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('dashboard/js/config.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('dashboard/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('dashboard/js/prism/prism.min.js')}}"></script>
    <script src="{{asset('dashboard/js/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('dashboard/js/custom-card/custom-card.js')}}"></script>
    <script src="{{asset('dashboard/js/tooltip-init.js')}}"></script>
    <!-- Plugins JS Ends-->

    <!-- Theme js-->
    <script src="{{asset('dashboard/js/script.js')}}"></script>

    @livewireScripts

    @yield('js_code')


    <script>

        window.livewire.on('success', (message) => {
            $(".modal").modal("hide");

            Swal.fire({
                title: message,
                text: 'Please wait ..',
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 1500
            })
        });

        window.livewire.on('alertSuccess', (message) => {

            $(".modal").modal('hide');

            Swal.fire({
                title: message,
                text: 'Please wait ..',
                icon: 'success',
                confirmButtonText: 'Ok'
            })

        })

        window.livewire.on('alertError', (message) => {
            Swal.fire({
                title: 'error!',
                text: message,
                icon: 'error',
                confirmButtonText: 'OK'
            })

            // setTimeout(function(){
            //     window.location.href = "";
            // }, 1500);
        })

    </script>

    <script type="text/javascript">

        var div = document.querySelector("div.page-wrapper")
        if (div.classList.contains('compact-sidebar')) {
            div.classList.remove("compact-sidebar");
        }
        if (div.classList.contains('modern-sidebar')) {
            div.classList.remove("modern-sidebar");
        }

        $('.modal').on('hide.bs.modal', function () {
            Livewire.emit('refreshModal')
        })
    </script>
    </body>
{{--@endif--}}
</html>
