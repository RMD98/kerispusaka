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
     <<div class="container container-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2>Halo!! <strong>Admin</strong></h2>
        <p class="text-muted">Layanan Pelaporan Dinas Ketahanan Pangan, Pertanian & Perikanan</p>
      </div>
      <div class="dropdown">
        <a href="#" class="dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown">
          {{ Auth::user()->user_name }}
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
            Logout
          </a>
        </div>
      </div>
    </div>

    <p class="alert alert-info">
      Sampaikan laporan terkait pemeriksaan ternak, permintaan IB, dan penanganan penyakit ternak secara cepat dan praktis.
    </p>

    <div class="row">
      <div class="col-md-4">
        <div class="option-section text-center">
          <h4><i class="fas fa-syringe"></i> Permintaan IB</h4>
          <button class="btn btn-light btn-action" data-toggle="modal" data-target="#modalIB">Pilih Kontak</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="option-section text-center">
          <h4><i class="fas fa-stethoscope"></i> Pengecekan Kebuntingan</h4>
          <button class="btn btn-light btn-action" data-toggle="modal" data-target="#modalPK">Pilih Kontak</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="option-section text-center">
          <h4><i class="fas fa-notes-medical"></i> Penanganan Penyakit</h4>
          <button class="btn btn-light btn-action" data-toggle="modal" data-target="#modalPP">Pilih Kontak</button>
        </div>
      </div>
    </div>

    <footer class="text-center mt-4">
      <p class="text-muted">Dinas Ketahanan Pangan, Pertanian & Perikanan Kota Banjar</p>
    </footer>
  </div>

  <!-- Modal IB -->
  <div class="modal fade" id="modalIB" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kontak Permintaan IB</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <button class="btn btn-outline-primary btn-block" onclick="call('lela')">drh Lela Nurlela</button>
          <button class="btn btn-outline-primary btn-block" onclick="call('bella')">drh Bella</button>
          <button class="btn btn-outline-primary btn-block" onclick="call('hanif')">drh Hanif</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal PK -->
  <div class="modal fade" id="modalPK" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kontak Pengecekan Kebuntingan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <button class="btn btn-outline-primary btn-block" onclick="call('desqi')">drh Desqi</button>
          <button class="btn btn-outline-primary btn-block" onclick="call('bella')">drh Bella</button>
          <button class="btn btn-outline-primary btn-block" onclick="call('uus')">Uus S.Pt</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal PP -->
  <div class="modal fade" id="modalPP" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kontak Penanganan Penyakit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <button class="btn btn-outline-primary btn-block" onclick="call('lela')">drh Lela Nurlela</button>
          <button class="btn btn-outline-primary btn-block" onclick="call('desqi')">drh Desqi</button>
          <button class="btn btn-outline-primary btn-block" onclick="call('hanif')">drh Hanif</button>
        </div>
      </div>
    </div>
  </div>
  </div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}}"></script>

    <script>
        function call(target){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                // url: "{{secure_url('/send-message')}}",
                url: "/send-message",
                type: 'POST', // or 'POST', 'PUT', 'DELETE'
                data: { peternak: (@json(Auth::user()).id_user)}, // Data to send
                dataType: 'json', // Expected data type of the response
                success: function(data) {
                    // $.ajax({
                    //     url: "{{secure_url('/call')}}",
                    //     type: 'POST', // or 'POST', 'PUT', 'DELETE'
                    //     data: { agent: target }, // Data to send
                    //     dataType: 'json', // Expected data type of the response
                    //     success: function(data) {
                    //         console.log('Success:', data);
                    //     },
                    //     error: function(xhr, status, error) {
                    //         console.error('Error:', error);
                    //     }
                    // });
                    console.log('Success:', data);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
            // alert('Permintaan panggilan telah dikirim. Silakan tunggu petugas menghubungi Anda.');
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
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js')}}"></script>

  </body>
</html>