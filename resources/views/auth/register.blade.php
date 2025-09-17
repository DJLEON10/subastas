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


  .register-box {
    background: linear-gradient(45deg, #42A5F5 50%, #3d07ff 50%);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 1;
    position: relative;
  }
</style>

<body class="container">
  <!-- Figuras geométricas animadas -->
  <div class="shape shape1"></div>
  <div class="shape shape2"></div>
  <div class="shape shape3"></div>

  <div class="register-box">
    <div class="card" style="border: none;">
      <div class="register-logo">
        <a href="../../index2.html"><img src="../img/Recurso 3 (1).jpg" style="width: 50%; height: auto; border-radius: 50%;"></a>
        </a>
      </div>

      <div class="card-body register-card-body" style="background-color: #ffffff; border-radius: 10px;">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="input-group mb-3">
            <input placeholder="Nombre" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="border-radius: 20px; border-color: #3d07ff;background-color: white;">

            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text" style="border-radius: 0 20px 20px 0; border-color: #ffff;">
                <span class="fas fa-user" style="color: #42A5F5;"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border-radius: 20px; border-color: #3d07ff;background-color: white;">

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text" style="border-radius: 0 20px 20px 0; border-color: #FFff;">
                <span class="fas fa-envelope" style="color: #42A5F5;"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input placeholder="Contraseña" id="password" type="password"
              class="form-control @error('password') is-invalid @enderror"
              name="password" required autocomplete="new-password"
              style="border-radius: 20px; border-color: #3d07ff;">
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }} </strong></span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text" style="border-radius: 0 20px 20px 0; border-color:  #ffff;background-color: white;">
                <button type="button" onclick="togglePassword('password')"
                  style="background: transparent; border: none; outline: none;">
                  <i class="fas fa-eye" style="color:  #42A5F5;"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Campo Repetir Contraseña -->
          <div class="input-group mb-3">
            <input placeholder="Repetir Contraseña" id="password-confirm" type="password"
              class="form-control" name="password_confirmation" required
              autocomplete="new-password" style="border-radius: 20px; border-color: #3d07ff; background-color: white;">
            <div class="input-group-append">
              <div class="input-group-text" style="border-radius: 0 20px 20px 0; border-color: #FFff;">
                <button type="button" onclick="togglePassword('password-confirm')"
                  style="background: transparent; border: none; outline: none;">
                  <i class="fas fa-eye" style="color:  #42A5F5;"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block" style="background-color:  #3d07ff; border-radius: 20px; border: none;">{{ __('Register') }}</button>
            </div>
          </div>
        </form>

        <div class="mt-3 text-center">
          <a href="{{ route('login') }}" style="color:  #3d07ff; text-decoration: none;">{{ __('Ya estoy registrado') }}</a>
        </div>
      </div>
       
    </div>
      
  </div>
  <input type="hidden" class="form-control" name="rol" value="1">
  <input type="hidden" class="form-control" name="estado" value="1">



  </form>
 
  </div>
  </div>
  </div>
  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      const icon = input.parentElement.querySelector('i');
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>
</body>


@endsection