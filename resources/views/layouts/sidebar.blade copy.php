<div class="d-flex mt-8">
    <a  class="logo navbar-nav" style="max-width: 4rem;">
        <h1 class="sitename"><img src="{{asset('/img/Logo.png')}}" alt="logo" srcset=""></h1>
    </a>
    <div class="topbar-divider "></div>
    <a  class="logo navbar-nav" style="max-width: 4rem;">
        <h1 class="sitename"><img src="{{asset('/img/keris-pusaka.png')}}" alt="logo" srcset=""></h1>
    </a>
</div>
    <nav class="space-y-2">
        <h1 class="text-l font-semibold ml-8 "><a href="{{route('dashboard')}}">DASHBOARD</a></h1>

        {!! menuItem('Ticket', '🎫', 'ticket') !!}
        {!! menuItem('Staff', '🧑‍💼', 'staff') !!}
        {!! menuItem('Kejadian', '📄', 'kejadian') !!}
        {!! menuItem('IB', '📌', 'ib') !!}
        {!! menuItem('PKB', '📌', 'pkb') !!}
        {!! menuItem('Kelahiran', '📌', 'kelahiran') !!} 
        {!! menuItem('Penyakit', '🦠', 'penyakit') !!}
        {!! menuItem('Peternak', '👥', 'peternak') !!}
        {!! menuItem('Sapi Betina', '🐄', 'betina') !!}
        {!! menuItem('Sapi Pejantan', '🐂', 'pejantan') !!}

    </nav>
@php
    function menuItem($label, $icon, $routeName)
    {
        $isActive = request()->routeIs($routeName . '*');

        $classes = $isActive
            ? 'text-blue-600 bg-blue-50 font-semibold border-l-4 border-blue-600'
            : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50 border-l-4 border-transparent';

        $url = route($routeName . '.index'); // auto route fix

        return "
            <a href=\"{$url}\" class=\"flex items-center space-x-3 px-3 py-2 rounded-lg transition {$classes}\">
                <span>{$icon}</span>
                <span>{$label}</span>
            </a>
        ";
    }
@endphp

<div class="navbar-nav " style="text-align-last: center;">
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
