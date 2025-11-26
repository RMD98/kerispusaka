<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <!-- <link rel="stylesheet" href="globals.css" /> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('/css/style2.css')}}" rel="stylesheet">
    <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="box">
      <div class="mockup">
        <div class="overlap">
          <div class="overlap-group">
            <div class="text-wrapper">Selamat Datang !</div>
          </div>
          <div class="div">
            <div class="text-wrapper-2">Halo!!</div>
            <div class="text-wrapper-3 dropdown no-arrow">
              <a href="#" class="dropdown-toggle"id="userDropdown" role="button"
                    data-toggle="dropdown">
                    {{Auth::user()->user_name}}
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                        Logout
                    </a>
                </div>
          </div>
          </div>
          <img class="customer-service" src="https://c.animaapp.com/md17hhmsokXFev/img/customer-service-1.png" />
          <p class="dinas-ketahanan">Dinas Ketahanan Pangan, Pertanian &amp; Perikanan Kota Banjar</p>
          <p class="layanan-pelaporan">Layanan Pelaporan Dinas Ketahanan Pangan, Pertanian &amp; Perikanan</p>
          <div class="rectangle"></div>
          <div class="rectangle-2"></div>
          <div class="rectangle-3"></div>
          <div class="rectangle-4"></div>
          <div class="div-wrapper">
            <p class="p">
              Sampaikan laporan terkait pemeriksaan ternak, permintaan IB, dan penanganan penyakit ternak secara cepat
              dan praktis.
            </p>
          </div>
          <div class="overlap-2">
            <div class="group">
              <div class="overlap-group-2">
                <div class="rectangle-5"></div>
                <div class="text-wrapper-4">HUBUNGI PETUGAS</div>
                <img class="doctor" src="https://c.animaapp.com/md17hhmsokXFev/img/doctor--1--1.png" />
              </div>
            </div>
            <button class="frame" onclick="call('+6285222179263')"></button>
            <button class="frame-2" onclick="alert('Button 2 clicked!')"></button>
            <button class="frame-3" onclick="alert('Button 3 clicked!')"></button>
            <button class="frame-4" onclick="alert('Button 4 clicked!')"></button>
            <button class="frame-5" onclick="alert('Button 5 clicked!')"></button>
          </div>
          <div class="overlap-3">
            <div class="overlap-wrapper">
              <div class="overlap-4">
                <img class="administrator" src="https://c.animaapp.com/md17hhmsokXFev/img/administrator-1.png" />
                <div class="text-wrapper-5">LAPOR PADA ADMIN</div>
              </div>
            </div>
            <button class="frame-6" onclick="alert('Button 6 clicked!')"></button>
            <button class="frame-7" onclick="alert('Button 7 clicked!')"></button>
            <button class="frame-8" onclick="alert('Button 8 clicked!')"></button>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function call(target){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{secure_url('/send-message')}}",
                // url: "/send-message",
                type: 'POST', // or 'POST', 'PUT', 'DELETE'
                data: { peternak: (@json(Auth::user()).id_user)}, // Data to send
                dataType: 'json', // Expected data type of the response
                success: function(data) {
	    	    alert('Permintaan panggilan telah dikirim. Silakan tunggu petugas menghubungi Anda.');
                    $.ajax({
                        url: "{{secure_url('/call')}}",
                        type: 'POST', // or 'POST', 'PUT', 'DELETE'
                        data: { agent: target }, // Data to send
                        dataType: 'json', // Expected data type of the response
                        success: function(data) {
                            console.log('Success:', data);

                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
			
                    });
                    console.log('Success:', data);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });	
        }
    </script>
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
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js')}}"></script>

  </body>
</html>