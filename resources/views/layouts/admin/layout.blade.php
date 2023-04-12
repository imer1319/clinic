<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('icono.png') }}" type="image/x-icon" />

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    @yield('styles')
    <style>
        .nav-link {
            border: 0px;
        }

        .nav-link:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body" id="app">
        <div class="main_container" style="background: #102562;">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <div class="ml-4 d-flex justify-content-center">
                            <img src="{{ asset('icono.png') }}" alt="icono" height="55px">
                            <a href="/" class="site_title"><span>{{ config('app.name') }}</span></a>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            @if(auth()->user()->profile->image)
                            <img src="{{ Storage::url( auth()->user()->profile->image) }}" alt="{{  auth()->user()->name }}" class="img-circle profile_img" style="border-radius: 50%;">
                            @else
                            <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}" alt="Avatar" class="img-circle profile_img">
                            @endif
                        </div>
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        @include('layouts.admin.sidebar')
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                @include('layouts.admin.navbar')
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                @include('layouts.admin.footer')
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            jsPermissions: {!! auth()->user()
                ?->jsPermissions() !!}
            }
        </script>
        <script src="/js/app.js"></script>
        <!-- jQuery -->
        <script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>

        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('admin/vendors/fastclick/lib/fastclick.js') }}"></script>
        <!-- NProgress -->
        <script src="{{ asset('admin/vendors/nprogress/nprogress.js') }}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{ asset('admin/build/js/custom.min.js') }}"></script>
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        @yield('scripts')

    </body>

    </html>
