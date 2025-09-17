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

  /* Estilo para el fondo dinámico del body */
  body {
    position: relative;
    overflow: hidden;
    animation: gradientBackgroundAnimation 10s infinite;
  }

  /* Configuración de las figuras geométricas */
  .shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    animation: moveDiagonal 10s infinite linear;
    z-index: 0;
  }

  .shape1 {
    width: 150px;
    height: 150px;
    top: -50px;
    left: -50px;
    background: rgba(255, 112, 67, 0.4);
    animation-duration: 12s;
  }

  .shape2 {
    width: 200px;
    height: 200px;
    bottom: -100px;
    right: -100px;
    background: rgba(66, 165, 245, 0.3);
    animation-duration: 15s;
  }

  .shape3 {
    width: 100px;
    height: 100px;
    top: 30%;
    left: 70%;
    background: rgba(255, 112, 67, 0.5);
    animation: moveVertical 8s infinite ease-in-out;
  }

  /* Estilo para la caja del login */
  .login-box {
    background: linear-gradient(45deg, #42A5F5 50%, #FF7043 50%);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 1;
    position: relative;
  }

  .login-card-body {
    background-color: #ffffff;
    border-radius: 10px;
  }
</style>

<body class="container">
  <!-- Figuras geométricas animadas -->
  <div class="shape shape1"></div>
  <div class="shape shape2"></div>
  <div class="shape shape3"></div>

  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">

        <div class="login-logo">
          <a href="../../index2.html"><img src="{{ asset('backend/dist/img/3.png') }}" style="width: 50%; height: auto;"></a>
        </div>

        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="input-group mb-3">
            <div class="col-md-12">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ingrese su email" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary" style="background-color: #FF7043; border-radius: 20px; border: none;">
                {{ __('Send Password Reset Link') }}
              </button>
            </div>
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</body>
<!-- /.login-box -->

@endsection
