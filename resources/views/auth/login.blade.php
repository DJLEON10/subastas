@extends('layouts.applogin')

@section('title', 'login')

@section('content')
<style>
  /* Estilo de animación para las figuras geométricas */
  @keyframes moveDiagonal {
    0% {
      transform: translate(0, 0) rotate(0deg);
    }
    50% {
      transform: translate(50px, 50px) rotate(180deg);
    }
    100% {
      transform: translate(0, 0) rotate(360deg);
    }
  }

  @keyframes moveVertical {
    0% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(30px);
    }
    100% {
      transform: translateY(0);
    }
  }

  body {
    position: relative;
    overflow: hidden;
    background-color: #42A5F5;
  }

  /* Configuración de las figuras geométricas */
  .shape {
    position: absolute;
    border-radius: 50%;
    background: #3d07ff;
    animation: moveDiagonal 10s infinite linear;
    z-index: 0;
  }

  .shape1 {
    width: 150px;
    height: 150px;
    top: -50px;
    left: -50px;
    background: #3d07ff;
    animation-duration: 12s;
  }

  .shape2 {
    width: 200px;
    height: 200px;
    bottom: -100px;
    right: -100px;
    background: #3d07ff;
    animation-duration: 15s;
  }

  .shape3 {
    width: 100px;
    height: 100px;
    top: 30%;
    left: 70%;
    background: #42A5F5;
    animation: moveVertical 8s infinite ease-in-out;
  }

 
</style>

<body class="container">
  <!-- Figuras geométricas animadas -->
  <div class="shape shape1"></div>
  <div class="shape shape2"></div>
  <div class="shape shape3"></div>

  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card" style="border: none;">
      <div class="login-logo">
        <a href="../../index2.html"><img src="../img/Recurso 3 (1).jpg" style="width: 50%; height: auto; border-radius: 50%;"></a>
      </div>

      <div class="card-body login-card-body" style="background-color: #ffffff; border-radius: 10px;">
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-radius: 20px; border-color: #3d07ff;">
            
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text" style="border-radius: 0 20px 20px 0; border-color: #ffff;">
                <span class="fas fa-envelope" style="color: #42A5F5;"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="current-password" style="border-radius: 20px; border-color: #3d07ff;">

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text" style="border-radius: 0 20px 20px 0; border-color: #ffff;">
                <span class="fas fa-lock" style="color: #42A5F5;"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block" style="background-color: #3d07ff; border-radius: 20px; border: none;">{{ __('Login') }}</button>
            </div>
            <div class="col-6">
              <a href="{{ route('register') }}" class="btn btn-success btn-block" style="background-color: #42A5F5; border-radius: 20px; border: none;">{{ __('Register') }}</a>
            </div>
          </div>

        </form>

        <div class="row mt-3">
          <div class="col-12 text-center">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" style="color: #3d07ff; text-decoration: none;">{{ __('Forgot Your Password?') }}</a>
            @endif
          </div>
        </div>
        
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</body>
<!-- /.login-box -->
@endsection
