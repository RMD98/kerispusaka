@extends('template/app')
@section('content')
<main class="main">
<!-- Services Section -->
  <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <span>Our Services<br></span>
      <h2>Our ServiceS</h2>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="card" >
            <h3>Laporan Umum</h3>
            <p>Memberikan Laporan atau Pengafuan yang bersifat UMUM terkait peternakan Anda</p>
            <div class="card-btn">
              <a href="#" class="btn-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#admin" onclick="showModal('Admin')">LAPOR ADMIN</a>
            </div>
          </div>
        </div>
        <!-- End Card Item -->
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="card" >
            <h3>Permintaan IB</h3>
            <p>Melakukan Permintaan Inseminasi Buatan (IB) untuk ternakn anda</p>
            <div class="card-btn">
              <a href="#" class="btn-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#contactModal" onclick="showModal('IB')">Minta IB</a>
            </div>
          </div>
        </div>
        <!-- End Card Item -->
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="card" >
            <h3>Pemeriksaan Kebuntingan</h3>
            <p>Melakukan permintaan Pengecekan Kebuntingan pada ternak anda</p>
            <div class="card-btn">
              <a href="#" class="btn-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#contactModal" onclick="showModal('Kebuntingan')">Perika Kebuntingan</a>
            </div>
          </div>
        </div>
        <!-- End Card Item -->
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="card" >
            <h3>Pemeriksaan Penyakit</h3>
            <p>Melakukan Laporan dan Permintaan Pemeriksaan Penyakit pada ternak Anda</p>
            <div class="card-btn">
              <a href="#" class="btn-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#contactModal" onclick="showModal('Penyakit')">Periksa Penyakit</a>
            </div>
          </div>
        </div>
    
        <div class="modal fade" id="admin" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="adminModalLabel">Daftar Petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                @foreach($admin as $admin)
                  <div class="contact">
                    <a href="#"class="btn-blue" onclick="call('{{ $admin->id_staff }}')">{{ $admin->nama }}</a>
                  </div>
                @endforeach
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="constModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="constModalLabel">Daftar Petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                @foreach($data as $staff)
                  <div class="contact">
                    <a href="#"class="btn-blue" onclick="call('{{ $staff->id_staff }}')">{{ $staff->nama }}</a>
                  </div>
                @endforeach
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card Item -->
      </div>
  </section>
  <section id="report" class="table section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <span>Daftar Laporan<br></span>
      <h2>Dafrar Laporan</h2>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">
        <div class="overflow-x-auto tbl-report data-tables" id="table">                
        </div> 
      </div>
    </div>        <!-- End Card Item -->
  </section>
</main>
@endsection
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
        $('#tck-tbl').DataTable();
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
      // document.getElementById('modalTitle').innerText = `Petugas untuk ${service}`;
      activeService = service;
    }
    function closeModal() {
      if(activeService=='Admin') {
        $('#admin').modal('hide');
      } else {
        $('#contactModal').modal('hide');
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
