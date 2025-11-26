@extends('layouts.template')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Halo Admin</title> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link href="{{asset('/css/home-style.css')}}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- <link href="{{asset('/css/style2.css')}}" rel="stylesheet"> -->


  @section('content')
<!-- Content remains unchanged -->

  <div class="shape shape1"></div>
  <div class="shape shape2"></div>
  <div class="shape shape3"></div>

  <div class="header">
    <div class="div">
            <div class="text-wrapper-3 dropdown no-arrow">
              <div class="logo-text"><i class="fas fa-comment-dots"></i> Halo!!
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
        </div>
    <div class="logo-container">
      <img src="/img/logo.png" alt="Logo">
    </div>
  </div>

  <div class="main">
    <div class="content">
      <h1>Selamat Datang !</h1>
      <p class="desc">Layanan Pelaporan Dinas Ketahanan Pangan, Pertanian & Perikanan</p>
      <div class="alert-box">
        Sampaikan laporan terkait pemeriksaan ternak, permintaan IB, dan penanganan penyakit ternak secara cepat dan praktis.
      </div>

      <div class="option-section">
        <div class="option-card">
          <h2><i class="fas fa-user-cog icon"></i> LAPOR ADMIN</h2>
          <div class="option" onclick="showModal('Admin')"><span><i class="fas fa-file-alt icon"></i> Laporan Umum</span></div>
        </div>
        <div class="option-card">
          <h2><i class="fas fa-syringe icon"></i> PERMINTAAN IB</h2>
          <div class="option" onclick="showModal('IB')"><span><i class="fas fa-syringe icon"></i> Tindakan IB</span></div>
          <div class="option" onclick="showModal('Kebuntingan')"><span><i class="fas fa-stethoscope icon"></i> Cek Kebuntingan</span></div>
        </div>
        <div class="option-card">
          <h2><i class="fas fa-notes-medical icon"></i> CEK PENYAKIT</h2>
          <div class="option" onclick="showModal('Penyakit')"><span><i class="fas fa-briefcase-medical icon"></i> Penanganan Penyakit</span></div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="contactModal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h3 id="modalTitle">Daftar Petugas</h3>
      <div class="contact-list">
        @foreach($data as $staff)
          <div class="contact">
            <a href="#" onclick="call('{{ $staff->phone }}')">{{ $staff->name }}</a>
          </div>
        @endforeach
        <div class="contact"><a href="#" onclick="call('+6285222179263')">drh Lela Nurlela</a></div>
        <!-- <div class="contact"><a href="#" onclick="call('+6285222179263')">drh Bella</a></div>
        <div class="contact"><a href="#" onclick="call('+6285222179263')">drh Desqi</a></div>
        <div class="contact"><a href="#" onclick="call('+6285222179263')">drh Hanif</a></div>
        <div class="contact"><a href="#" onclick="call('+6285222179263')">Uus S.Pt</a></div> -->
      </div>
    </div>
  </div>

@stop
 
@push('scripts')
  <script>
    function showModal(service) {
      document.getElementById('contactModal').style.display = 'flex';
      document.getElementById('modalTitle').innerText = `Petugas untuk ${service}`;
    }
    function closeModal() {
      document.getElementById('contactModal').style.display = 'none';
    }
    window.onclick = function(event) {
      const modal = document.getElementById('contactModal');
      if (event.target == modal) {
        closeModal();
      }
    }
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
                data: { peternak: (@json(Auth::user()).id_user), agent:target}, // Data to send
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
@endpush
