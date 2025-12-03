<head>
    <script src="https://cdn.tailwindcss.com"></script>
    @if(Auth::user()->role == 'peternak')
        <link href="{{asset('/css/home-style.css')}}" rel="stylesheet">
        <link href="{{asset('/vendor/aos/aos.css')}}" rel="stylesheet">
        <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
        <link href="{{asset('/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{asset('/css/main.css')}}" rel="stylesheet">

    @else

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">



        <!-- Custom fonts for this template-->
        <link
            href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <script type="text/javascript" src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
        <style>
            #tableauViz {
                width: 100vh;
                height: 95vh; /* Mengisi seluruh tinggi viewport */
            }
        </style>

    @endif
        <title>DKPPP</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{asset('/img/Logo.png')}}" type="image/x-icon">    
        <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">


</head>
<body id="page-top">
    <header>
        @if(Auth::user()->role == 'peternak')
            
        @else
            @include('layouts/navbar')
        @endif
    </header>
    @if(Auth::user()->role == 'peternak')
            @yield('content')
    @else
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div class="flex min-h-screen">    
                <aside class="w-64 bg-white shadow-md px-4 py-6 flex flex-col">
                    <h2 class="text-2xl font-bold text-blue-600 mb-6">My App</h2>
                    @include('layouts.sidebar')
                </aside>
                <!-- <div id="content"> -->
                    <!-- </div> -->
                    @yield('content')
                </div>
            </div>
        </div>
        @endif
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                </div>
            </div>
        </div>
    </div>
     <!-- start footer Area -->
    <footer class="sticky-footer bg-white">
        <div class="footer">
            Dinas Ketahanan Pangan, Pertanian & Perikanan Kota Banjar
        </div>
    </footer>
    <!-- End footer Area -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js')}}"></script>
    <script src="{{ asset('js/whatsapp.js') }}"></script>

    <!-- Page level plugins -->
    @stack('script')
</body>