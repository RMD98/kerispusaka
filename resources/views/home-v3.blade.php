@extends('layouts.template')
  

  @section('content')
<!-- Content remains unchanged -->


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
      <img src="{{asset('/img/Logo.png')}}" alt="Logo">
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
        <div class="option-card" aos-data="fade-up">
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
  <div class="main">

    <div class="content">
      <h1>Daftar Laporan Anda</h1>
      <div class="overflow-x-auto" id="table">
        
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
            <a href="#" onclick="call('{{ $staff->id_staff }}')">{{ $staff->nama }}</a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="modal" id="admin">
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h3 id="modalTitle">Daftar Petugas</h3>
      <div class="contact-list">
        @foreach($admin as $admin)
          <div class="contact">
            <a href="#" onclick="call('{{ $admin->id_staff }}')">{{ $admin->nama }}</a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  
@stop
 
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    var activeService = null;
    $.ajax({
      url:"{{route('ticket.table', ['id' => Auth::user()->id_user])}}",
      type:'GET',
      dataType:'html',
      success:function(response){
        $('#table').html(response);
      },
      error:function(xhr,status,error){
        console.error('Error fetching ticket table:', error);
      }
    })

    //Show Modal Untuk Pelaporan
    function showModal(service) {
      if (service=='Admin') {
        document.getElementById('admin').style.display = 'flex';
      } else {
        document.getElementById('contactModal').style.display = 'flex';
      }
      // document.getElementById('contactModal').style.display = 'flex';
      document.getElementById('modalTitle').innerText = `Petugas untuk ${service}`;
      activeService = service;
    }
    function closeModal() {
      if(activeService=='Admin') {
        document.getElementById('admin').style.display = 'none';
      } else {
        document.getElementById('contactModal').style.display = 'none';
      }
      // document.getElementById('contactModal').style.display = 'none';
    }
    window.onclick = function(event) {
      const modal = document.getElementById('contactModal');
      if (event.target == modal) {
        closeModal();
      }
    }

    //Fungsi Untuk Menghubungi dan Memberi Pesan Pada Petugas
    function call(target){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              // url:"{{secure_url('/checklimit')}}/"+(@json(Auth::user()).id_user),
              url:"{{route('ticket.checklimit', ['id' => Auth::user()->id_user])}}",
              // url:"/checklimit/"+(@json(Auth::user()).id_user),
              type:'GET',
              dataType:'json',
              success:function(response){
                if(response>=3){
                  // alert('Maaf, Anda telah mencapai batas maksimal 3 laporan per hari. Silakan coba lagi besok.');
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR!',
                        text: response.message ?? 'Maaf, Anda telah mencapai batas maksimal 3 laporan per hari. Silakan coba lagi besok.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                  return;
                }
                else{
                  $.ajax({
                  // url: "{{secure_url('/send-message')}}",
                    url: "{{route('call.sendMessage')}}",
                    type: 'POST', // or 'POST', 'PUT', 'DELETE'
                    data: { peternak: (@json(Auth::user()).id_user), agent:target, jenis:activeService}, // Data to send
                    dataType: 'json', // Expected data type of the response
                    success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'SUCCESS!',
                        text: response.message ?? 'Permintaan panggilan telah dikirim. Silakan tunggu petugas menghubungi Anda.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                        $.ajax({
                            url: "{{route('call.start')}}",
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
                } 
            })
            
            closeModal(); // Close the modal after sending the request	
        }
  </script>
@endpush
