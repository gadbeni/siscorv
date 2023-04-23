<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <title>@yield('page_title', setting('admin.title') . " - " . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="assets-path" content="{{ route('voyager.voyager_assets') }}"/>

    @yield('meta')

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"> -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    


    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/small.css') }}">
    <link rel="stylesheet" href="{{ asset('css/h.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/loader.css') }}"> --}}
    <style>
        .form-control, .select2-selection, .mce-tinymce {
            border: 1px solid #464545 !important;
            /* color: #f40202; */
            color:rgb(30, 29, 29) !important;
            /* font-weight: 200; */
        }
        label
        {
            color: rgb(33, 33, 33) !important;
        }
    </style>
    

    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif


    <!-- App CSS -->
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    @stack('css')
    @yield('css')
    @if(__('voyager::generic.is_rtl') == 'true')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="{{ voyager_asset('css/rtl.css') }}">
    @endif

    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background:{{ config('voyager.primary_color','#22A7F0') }};
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary{
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus{
            background:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .voyager .breadcrumb a{
            color:{{ config('voyager.primary_color','#22A7F0') }};
        }
    </style>

    <style>
        @media screen and (max-width: 768px) {
            .div-phone{
                padding: 0px !important
            }
            .div-phone-main{
                padding: 0px !important
            }
        }
    </style>

    @if(!empty(config('voyager.additional_css')))<!-- Additional CSS -->
        @foreach(config('voyager.additional_css') as $css)<link rel="stylesheet" type="text/css" href="{{ asset($css) }}">@endforeach
    @endif

    @yield('head')
    
    @livewireStyles
</head>

<body class="voyager @if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif">

    <div id="voyager-loader">
        <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
        @if($admin_loader_img == '')
            <img src="{{ asset('images/loading.png') }}" alt="Voyager Loader">
        @else
            <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
        @endif
    </div>

    <?php
    if (\Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'http://') || \Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'https://')) {
        $user_avatar = Auth::user()->avatar;
    } else {
        $user_avatar = Voyager::image(Auth::user()->avatar);
    }
    ?>

    <div class="app-container">
        <div class="fadetoblack visible-xs"></div>
        <div class="row content-container">
            @include('voyager::dashboard.navbar')
            @include('voyager::dashboard.sidebar')
            <script>
                (function(){
                        var appContainer = document.querySelector('.app-container'),
                            sidebar = appContainer.querySelector('.side-menu'),
                            navbar = appContainer.querySelector('nav.navbar.navbar-top'),
                            loader = document.getElementById('voyager-loader'),
                            hamburgerMenu = document.querySelector('.hamburger'),
                            sidebarTransition = sidebar.style.transition,
                            navbarTransition = navbar.style.transition,
                            containerTransition = appContainer.style.transition;

                        sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition =
                        appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition =
                        navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = 'none';

                        if (window.innerWidth > 768 && window.localStorage && window.localStorage['voyager.stickySidebar'] == 'true') {
                            appContainer.className += ' expanded no-animation';
                            loader.style.left = (sidebar.clientWidth/2)+'px';
                            hamburgerMenu.className += ' is-active no-animation';
                        }

                    navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = navbarTransition;
                    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition = sidebarTransition;
                    appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition = containerTransition;
                })();
            </script>
            <!-- Main Content -->
            <div class="container-fluid div-phone-main">
                <div class="side-body padding-top">
                    @yield('page_header')
                    <div id="voyager-notifications"></div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('voyager::partials.app-footer')

    <!-- Javascript Libs -->


    <script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>

    {{-- Para sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (setting('configuracion.navidad'))
        {{-- <link href="{{asset('navidad/css/style.css')}}" rel="stylesheet" type="text/css" /> --}}
        {{-- <script type="text/javascript" src="{{asset('navidad/js/jquery-latest.min.js')}}"></script> --}}
        {{-- <script src="{{asset('navidad/js/snowfall.jquery.js')}}"></script> --}}
        <script type="text/javascript" src="{{asset('navidad/snow.js')}}"></script>
        <script type="text/javascript">
            $(function() {
                $(document).snow({ SnowImage: "{{ asset('navidad/image/icon.png') }}" });
            });
        </script>
    @endif

    <script>
        @if(Session::has('alerts'))
            let alerts = {!! json_encode(Session::get('alerts')) !!};
            helpers.displayAlerts(alerts, toastr);
        @endif

        @if(Session::has('message'))

        // TODO: change Controllers to use AlertsMessages trait... then remove this
        var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
        var alertMessage = {!! json_encode(Session::get('message')) !!};
        var alerter = toastr[alertType];

        if (alerter) {
            alerter(alertMessage);
        } else {
            toastr.error("toastr alert-type " + alertType + " is unknown");
        }
        @endif
    </script>
    @include('voyager::media.manager')

    <script>
        const IP_ADDRESS = "{{ env('APP_URL', '127.0.0.1') }}";
        const SOCKET_PORT = "{{ env('SOCKET_PORT', '3000') }}";

        $(function() {
            // Pedir autorización para mostrar notificaciones
            Notification.requestPermission();

            let socket = io(IP_ADDRESS + ':' + SOCKET_PORT);
            socket.on('sendNotificationToClient', (id) => {
                let user_id = "{{ Auth::user()->id }}";
                if(user_id == id){
                    if(Notification.permission=='granted'){
                        let notificacion = new Notification('Nueva derivación',{
                            body: 'Tienes un trámite nuevo',
                            icon: '{{ url("images/icon.png") }}'
                        });

                        notificacion.onclick = function(event) {
                            event.preventDefault(); // Previene al buscador de mover el foco a la pestaña del Notification
                            window.location = "{{ route('bandeja.index') }}";
                        }
                    }

                    let cont = $('#badge-notification .badge').text();
                    if(!cont){
                        let url = "{{ route('bandeja.index') }}";
                        $('#badge-notification').html(`<a href="${url}"> <span class="voyager-bell text-danger" style="font-size: 25px"></span> <span class="badge" style="margin-left: -10px">1</span> </a>`);
                    }else{
                        $('#badge-notification .badge').text(parseFloat(cont)+1);
                    }
                }
            });
        });
    </script>

    @yield('javascript')
    @stack('javascript')
    @if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
        @foreach(config('voyager.additional_js') as $js)<script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
    @endif
    @livewireScripts

    {{-- Socket.io --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
</body>
</html>
