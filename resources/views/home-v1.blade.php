<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halo Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f5f5f5;
      color: #333;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom right, #e1f7f6 30%, #ffffff 100%);
      clip-path: polygon(0 0, 100% 0, 100% 20%, 0 70%);
      z-index: -1;
    }
    .shape {
      position: absolute;
      z-index: 0;
      opacity: 0.1;
    }
    .shape1 {
      width: 120px;
      height: 120px;
      background: #0d7377;
      border-radius: 50% 20% 50% 80%;
      top: 100px;
      left: -40px;
    }
    .shape2 {
      width: 100px;
      height: 100px;
      background: #2f6cdf;
      border-radius: 70% 30% 60% 40%;
      bottom: 30px;
      right: -40px;
    }
    .shape3 {
      width: 60px;
      height: 60px;
      background: #21b6b5;
      border-radius: 40% 60% 60% 40%;
      top: 45%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #e1f7f6;
      border-bottom: 2px solid #0d7377;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      position: relative;
      z-index: 1;
    }
    .header .logo-text {
      font-size: 24px;
      font-weight: bold;
      color: #0d7377;
    }
    .header .logo-text span {
      color: #2f6cdf;
    }
    .header .logo-container {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .header img {
      height: 50px;
    }
    .main {
      flex: 1;
      padding: 30px 20px;
      max-width: 1200px;
      width: 100%;
      margin: auto;
      position: relative;
      z-index: 2;
    }
    .content {
      background: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    h1 {
      font-size: 28px;
      color: #0d7377;
      margin-bottom: 10px;
    }
    .desc {
      color: #333;
      font-size: 17px;
      margin-bottom: 20px;
    }
    .alert-box {
      background: #e1f7f6;
      padding: 18px;
      border-left: 5px solid #0d7377;
      margin-bottom: 30px;
      font-size: 15px;
    }
    .option-section {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    @media (min-width: 768px) {
      .option-section {
        flex-direction: row;
      }
    }
    .option-card {
      flex: 1;
      background: #0d7377;
      border-radius: 16px;
      padding: 25px;
      color: white;
      transition: transform 0.2s ease;
    }
    .option-card:hover {
      transform: translateY(-4px);
    }
    .option-card h2 {
      margin-bottom: 18px;
      font-size: 18px;
    }
    .option-card .option {
      background-color: #21b6b5;
      padding: 12px 16px;
      margin-bottom: 12px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      font-size: 15px;
    }
    .option-card .option:hover {
      background-color: #1ea6a5;
    }
    .footer {
      text-align: center;
      padding: 15px;
      font-size: 14px;
      color: #888;
      background-color: #fff;
      border-top: 1px solid #ddd;
      margin-top: auto;
      z-index: 1;
    }
    .icon {
      margin-right: 10px;
    }
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .modal-content {
      background: white;
      padding: 25px;
      border-radius: 16px;
      max-width: 420px;
      width: 90%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      position: relative;
      animation: slideDown 0.3s ease-out;
    }
    @keyframes slideDown {
      from { transform: translateY(-20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .modal-content h3 {
      margin-top: 0;
      margin-bottom: 15px;
      color: #0d7377;
    }
    .contact-list .contact {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      font-weight: 500;
    }
    .contact-list .contact:last-child {
      border-bottom: none;
    }
    .contact-list .contact a {
      text-decoration: none;
      color: #0d7377;
    }
    .contact-list .contact a:hover {
      text-decoration: underline;
    }
    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 18px;
      cursor: pointer;
      color: #aaa;
    }
    .close-btn:hover {
      color: #555;
    }
  </style>
</head>
<body>
  <div class="shape shape1"></div>
  <div class="shape shape2"></div>
  <div class="shape shape3"></div>

  <div class="header">
    <div class="logo-text"><i class="fas fa-comment-dots"></i> Halo!! <span>admin</span></div>
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
        <div class="contact"><a href="https://wa.me/6281234567890" target="_blank">drh Lela Nurlela</a></div>
        <div class="contact"><a href="https://wa.me/6289876543210" target="_blank">drh Bella</a></div>
        <div class="contact"><a href="https://wa.me/6281122334455" target="_blank">drh Desqi</a></div>
        <div class="contact"><a href="https://wa.me/6282233445566" target="_blank">drh Hanif</a></div>
        <div class="contact"><a href="https://wa.me/6289988776655" target="_blank">Uus S.Pt</a></div>
      </div>
    </div>
  </div>

  <div class="footer">
    Dinas Ketahanan Pangan, Pertanian & Perikanan Kota Banjar
  </div>

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
  </script>
</body>
</html>
