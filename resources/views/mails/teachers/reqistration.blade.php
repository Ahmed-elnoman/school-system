<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />
    <!-- Icons css -->
    <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{ URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
    <!--  Sidebar css -->
    <link href="{{ URL::asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css-rtl/sidemenu.css') }}">
    @yield('css')
    <!--- Style css -->
    <link href="{{ URL::asset('assets/css-rtl/style.css') }}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{ URL::asset('assets/css-rtl/style-dark.css') }}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ URL::asset('assets/css-rtl/skin-modes.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('assets/img/media/lockscreen.png') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="mb-5 d-flex mx-auto"> <a href="{{ url('/' . ($page = 'index')) }}"
                                        class="mx-auto d-flex">
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28 text-dark ml-2">
                                            مدرسة المستقبل
                                        </h1>
                                    </a></div>
                                <div class="main-card-signin d-md-flex bg-white">
                                    <div class="p-4 wd-100p">
                                        <div class="main-signin-header">
                                            <div class="avatar avatar-xxl avatar-xxl mx-auto text-center mb-2"><img
                                                    alt="" class="avatar avatar-xxl rounded-circle  mt-2 mb-2 "
                                                    src="{{ URL::asset('assets/img/faces/6.jpg') }}"></div>
                                            <div class="mx-auto text-center mt-4 mg-b-20">
                                                <h5 class="mg-b-10 tx-16">استاذ {{ $teacher_name }}</h5>
                                                <p class="tx-13 text-muted">يسرنا أن نرحب بك يا استاذ
                                                    {{ $teacher_name }} في
                                                    هذا العام الدراسي الجديد أفضل استقبال، بالورود والمسك والعنبر</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
</body>

</html>
