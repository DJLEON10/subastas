@extends('layouts.applogin')

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

  .card {
    background: linear-gradient(45deg, #42A5F5 50%, #FF7043 50%);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 1;
    position: relative;
    width: 100%;
    max-width: 500px;
  }

  .card-header {
    background-color: #ffffff;
    border-radius: 10px;
    text-align: center;
    font-size: 20px;
    color: #FF7043;
  }

  .form-control {
    border-radius: 20px;
    border-color: #FF7043;
  }

  .form-label {
    font-weight: bold;
    color: #333;
  }

  .btn-primary {
    background-color: #FF7043;
    border-radius: 20px;
    border: none;
  }

  .invalid-feedback {
    color: #FF7043;
  }

</style>

<body class="container">
  <!-- Figuras geométricas animadas -->
  <div class="shape shape1"></div>
  <div class="shape shape2"></div>
  <div class="shape shape3"></div>

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4">
      <div class="card-header text-center">{{ __('Reset Password') }}</div>

      <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">

          <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
              {{ __('Reset Password') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
@endsection
