<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  </head>
  <body>
    
<body>
  <div class="card-container">
    <div class="login-card">
      <!-- Header Top Icon/Text -->
      <!-- <div class="header">
        <div class="circle-top-left">
          <i class="fa-solid fa-user-tie"></i> Pelaporan <strong>Masyarakat</strong>
        </div>
      </div> -->
      <img src="{{ asset('/img/top-cloud.png') }}" class="top-cloud" alt="Top Cloud">
      <img src="{{ asset('/img/bot-cloud.png') }}" class="bot-cloud" alt="Bottom Cloud">

      <!-- Logo -->
      <img class="logo" src="{{ asset('/img/Logo.png') }}" alt="DKPPP Logo" />

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="input-group">
          <label class="input-label" for="user_name">Username</label>
          <input id="user_name" class="input-field" type="text" name="user_name" required autofocus />
        </div>

        <div class="input-group">
          <label class="input-label" for="password">Password</label>
          <input id="password" class="input-field" type="password" name="password" required />
          <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
        </div>

        <div class="forgot-container">
          <a href="{{ route('password.request') }}" class="forgot-password">Lupa password ?</a>
        </div>

        <button type="submit" class="login-button">LOGIN</button>
      </form>

      <!-- Bottom Decoration -->
      
    </div>
  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>

  
  </body>
</html>
