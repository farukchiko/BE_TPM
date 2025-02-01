<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <!-- CS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />

    <!-- JS -->
    <script src="{{ asset('js/login.js') }}" defer></script>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  </head>
  <body>
    <div class="container">
      <div class="top-content">
      <img src="{{ asset('assets/images/img-bncc-logo.png') }}" alt="Logo BNCC" class="img-logo-bncc" />
        <h2 class="text-greet">Welcome back!</h2>
      </div>

      <div class="mid-content">
        <div class="input-wrapper">
          <p class="input-name">Team Name</p>
          <input type="text" placeholder="team name" class="form-input" id="input-team" />
          <p class="error-message" id="team-error"></p>
        </div>
        <div class="input-wrapper">
          <p class="input-name">Password</p>
          <div class="input-eyes" id="input-eyes">
            <input type="password" placeholder="password" class="form-input-pass" id="input-pass" />
            <div class="eyes-container">
              <img src="{{ asset('assets/icons/ic-eyes-open.svg') }}" alt="Icon Eyes" id="ic-eyes" />
            </div>
          </div>
          <p class="error-message" id="pass-error"></p>
        </div>
      </div>

      <div class="bottom-content">
        <div class="btn-bottom">
          <button class="btn-login" id="btn-login">Login</button>
          <button class="btn-login-admin" id="btn-login-admin">Login as Admin</button>
        </div>
        <p class="text-confirm">
          Don't have account?
          <a href="/register-group">Sign up</a>
        </p>
      </div>
    </div>
  </body>
</html>
