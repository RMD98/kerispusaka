<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div>
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
                    <img src="{{asset('/img/Logo.png')}}" width="100rem" alt="logo" srcset="">
                    <img src="{{asset('/img/keris-pusaka.png')}}" width="100rem" alt="logo" srcset="">
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>
            
            <!-- Divider -->
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('ticket.index')}}">
                        <i class="fas fa-fw fa-ticket-alt"></i>
                    <span>Tickets</span></a>
                </li>
                
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                <a class="nav-link" href="{{route('staff.index')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Staff</span></a>
                </li>
                
                <!-- Heading -->
                <li class="nav-item">
                    
                    <div class="d-flex justify-content-between align-items-center nav-link">
                        
                        <!-- ✅ Normal Link (Redirect) -->
                        <a href="{{route('kejadian.index')}}" class="text-white text-decoration-none flex-grow-1">
                            <i class="fas fa-fw fa-file"></i>
                            <span>Kejadian</span>
                        </a>
                        
                        <!-- ✅ Toggle Button (Arrow Only) -->
                        <button class="btn btn-link text-white p-0 ml-2 collapsed"
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapseKejadian"
                            aria-expanded="false"
                            aria-controls="collapseKejadian">
                            
                            <i class="fas fa-chevron-right arrow-icon"></i>
                            
                        </button>
                        
                    </div>
                    
                    <!-- ✅ Collapse Content -->
                    <div id="collapseKejadian" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Rangkaian Kejadian</h6>
                            <a class="collapse-item" href="{{route('ib.index')}}">IB</a>
                            <a class="collapse-item" href="{{route('pkb.index')}}">PKB</a>
                            <a class="collapse-item" href="{{route('kelahiran.index')}}">Kelahiran</a>
                        </div>
                    </div>
                    
                </li>
                
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    
                    <div class="d-flex justify-content-between align-items-center nav-link">
                        
                        <!-- ✅ Normal Link (Redirect) -->
                        <a href="{{route('peternak.index')}}" class="text-white text-decoration-none flex-grow-1">
                            <i class="fas fa-fw fa-user"></i>
                            <span>Peternak</span>
                        </a>
                        
                    <!-- ✅ Toggle Button (Arrow Only) -->
                    <button class="btn btn-link text-white p-0 ml-2 collapsed"
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapsePeternak"
                            aria-expanded="false"
                            aria-controls="collapsePeternak">
                            
                            <i class="fas fa-chevron-right arrow-icon"></i>
                            
                        </button>
                        
                    </div>

                    <!-- ✅ Collapse Content -->
                    <div id="collapsePeternak" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header"></h6>
                            <a class="collapse-item" href="{{route('betina.index')}}">Sapi Betina</a>
                        </div>
                    </div>
                
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{route('pejantan.index')}}">
                    <i class="fa fa-fw fa-mars"></i>
                    <span>Pejantan</span></a>
                </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- Nav Item - Charts -->
            
            
            <!-- Divider -->
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
                <ul class="navbar-nav ms-auto">
                        @guest
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
            <hr class="sidebar-divider d-none d-md-block">
            
            <!-- Sidebar Toggler (Sidebar) -->
            </div>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            

            
        </ul>