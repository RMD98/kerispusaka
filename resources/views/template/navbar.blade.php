<nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="" role="button">
                    {{Auth::user()->user_name}}
              </a></li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                        Logout
                    </a></li>
          <!-- <li><a href="contact.html">Contact</a></li> -->
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
       
</nav>