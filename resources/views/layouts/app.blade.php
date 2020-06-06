<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>SmadHadits by Smadia</title>
    <meta charset="UTF-8">
    <meta name="description" content="SmadHadits adalah aplikasi klasifikasi hadits berdasarkan perawi hadits. SmadHadits dapat memperkirakan keshahihan suatu hadits yang dilihat dari perawi hadits. Tidak hanya itu, Smadhadits juga dapat memberikan hadits-hadits yang mirip sesuai dengan hadits yang diinputkan dan juga memberikan informasi-informasi hadits.">
    <meta name="keywords" content="smadia, hadits, hadith, smadhadith, smadhadits, hadis, smadia hadis, klasifikasi hadits, klasifikasi hadith, hadith classification, hadith neural network, neural network, pca, principal component analysis, pca nn, pca neural network, layanan ai, kecerdasan buatan, keshahihan hadits, kesahihan hadits, tingkatan hadits">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification" content="J8li5Yjhci9RxICfFSZglwHU7zoTvZYaVEPi1rCWgnk" />

    <meta name="google-site-verification" content="N1g7MyigRRf5kOuKRMqtd-MKdIGrKafI82PMoLXvoc0" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="http://smadia.ayolaco.com//storage/settings/December2019/VBFGs00n9kjSitalFqL3.png" type="image/x-icon">
    <meta property="og:image" content="http://smadia.ayolaco.com//storage/settings/December2019/VBFGs00n9kjSitalFqL3.png" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('template/css/magnific-popup.css') }}"/>
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.min.css') }}"/>

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}"/>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('head')

</head>
<body>
<!-- Page Preloder -->
{{--<div id="preloder">--}}
{{--    <div class="loader"></div>--}}
{{--</div>--}}

<!-- Main section start -->
<div class="main-site-warp">
    @include('layouts.menu')
    <header class="header-section">
        <div class="nav-switch">
            <i class="fa fa-bars"></i>
        </div>
        <div class="header-social">
            <a target="_blank" href="https://instagram.com/smadia.id"><i class="fa fa-instagram"></i></a>
            <a target="_blank" href="https://www.facebook.com/smadia.id"><i class="fa fa-facebook"></i></a>
            <a target="_blank" href="https://twitter.com/smadiaID"><i class="fa fa-twitter"></i></a>
        </div>
    </header>
    <div class="site-content-warp">
        <!-- Left Side section -->
        <div class="main-sidebar">
            <div class="mb-warp">
                <a href="{{ route('home') }}" class="site-logo">
                    <h2>SMAD<br>HADITS</h2>
                    <p>Klasifikasi Hadits</p>
                </a>
                <div class="about-info">
                    @yield('info')
                    <p>By <a target="_blank" href="http://smadia.id/">smadia.id</a> - <a target="_blank" href="https://www.instagram.com/rafy_aa/">rafy_aa</a> | Reference : <a href="https://www.instagram.com/nuha_tok/" target="_blank">Ulin Nuha</a></p>
                </div>
                <a href="{{ route('retrieval') }}" class="site-btn">Hadits Retrieval <img src="{{ asset('template/img/arrow-right.png') }}"
                                                                   alt=""></a>
                <a href="{{ route('classification') }}" class="site-btn">Berdasarkan Perawi <img src="{{ asset('template/img/arrow-right.png') }}"
                                                                     alt=""></a>
            </div>
        </div>
        <!-- Left Side section end -->
        <!-- Page start -->

    @yield('content')

    <!-- Page end -->
    </div>
    <div class="copyright">
        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
            All rights reserved | By <a target="_blank" href="http://smadia.id/">smadia.id</a> - <a target="_blank" href="https://www.instagram.com/rafy_aa/">Rafy AA</a> | Reference : <a href="https://www.instagram.com/nuha_tok/" target="_blank">Ulin Nuha</a> | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
    </div>
</div>
<!-- Main section end -->

<!--====== Javascripts & Jquery ======-->
<script src="{{ asset('template/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('template/js/jquery.nicescroll.min.js') }}"></script>
{{--<script src="{{ asset('template/js/circle-progress.min.js') }}"></script>--}}
<script src="{{ asset('template/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('template/js/main.js') }}"></script>
<script>
    // setTimeout(function () {
    //     $('#preloder').remove()
    // }, 1000)
</script>
@stack('js')
</body>
</html>
