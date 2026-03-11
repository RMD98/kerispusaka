<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    
    <!-- Topbar Navbar -->
    <a  class="logo ml-auto navbar-nav" style="max-width: 5rem;">
        <h1 class="sitename"><img src="{{asset('/img/Logo.png')}}" alt="logo" srcset=""></h1>
    </a>
    <div class="topbar-divider "></div>
    <a  class="logo navbar-nav" style="max-width: 5rem;">
        <h1 class="sitename"><img src="{{asset('/img/keris-pusaka.png')}}" alt="logo" srcset=""></h1>
    </a>
    <div class="navbar-nav ml-auto" style="text-align-last: center;">
        <ul class="mb-0">
        <!-- <i class="user fa fa-2x fa-user"></i>   -->
        <span class="fa-stack fa-1x">
            <i class="fas fa-circle fa-stack-2x" style="color: #ccc;"></i>
            <i class="fas fa-user fa-stack-1x fa-inverse"></i>
        </span>

            <!-- <li class="nav-item">
                <a href="#" class="nav-link" onclick="sendWhatsAppMessage()">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 navbar-brand">Kirim Notif</span>
                </a>
            </li> -->

            <!-- Nav Item - User Information -->
            @guest
            <ul class="navbar-nav ms-auto">
                <li class="nav-link">
                    <b>
                        <a href="{{ route('login') }}" class="nav-link text-uppercase mr-2 d-none d-lg-inline " href="index.html">Log in</a>
                    </b>
                    </li>
                </ul>
            @else
            <li class="nav-item dropdown no-arrow">
                <a class=" dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-lg-inline text-gray-600">{{Auth::user()->username}}</span>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
            @endguest        
        </ul>
        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

    </div>
</nav>