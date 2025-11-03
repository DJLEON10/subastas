@extends('layouts.applogin')

@section('content')

<style>
  /* Reset y configuración base */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    background: linear-gradient(135deg, #4a1a2c 0%, #3d1520 50%, #4a1a2c 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow-x: hidden;
    overflow-y: auto;
    position: relative;
    padding: 20px 0;
  }

  /* Partículas de fondo animadas */
  .particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
  }

  .particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(218, 165, 32, 0.3);
    border-radius: 50%;
    animation: float 6s infinite ease-in-out;
  }

  .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
  .particle:nth-child(2) { left: 20%; animation-delay: -2s; }
  .particle:nth-child(3) { left: 30%; animation-delay: -4s; }
  .particle:nth-child(4) { left: 40%; animation-delay: -1s; }
  .particle:nth-child(5) { left: 50%; animation-delay: -3s; }
  .particle:nth-child(6) { left: 60%; animation-delay: -5s; }
  .particle:nth-child(7) { left: 70%; animation-delay: -1.5s; }
  .particle:nth-child(8) { left: 80%; animation-delay: -3.5s; }
  .particle:nth-child(9) { left: 90%; animation-delay: -2.5s; }

  @keyframes float {
    0%, 100% {
      transform: translateY(100vh);
      opacity: 0;
    }
    50% {
      opacity: 1;
    }
  }

  /* Contenedor principal del register */
  .register-container {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 2.5rem 2rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.15);
    width: 100%;
    max-width: 450px;
    position: relative;
    z-index: 1;
    animation: slideIn 0.8s ease-out;
    margin: auto;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Header del register */
  .register-header {
    text-align: center;
    margin-bottom: 2rem;
  }

  .register-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    border-radius: 50%;
    margin: 0 auto 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(240, 147, 251, 0.4);
  }

  .register-icon i {
    font-size: 1.8rem;
    color: white;
  }

  .register-title {
    color: #fff;
    font-size: 1.6rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
    background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .register-subtitle {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
    font-weight: 400;
  }

  /* Estilos de formulario */
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.2rem;
  }

  .form-group {
    margin-bottom: 1.2rem;
    position: relative;
  }

  .form-group.full-width {
    grid-column: span 2;
  }

  .form-label {
    display: block;
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.8rem;
    margin-bottom: 0.4rem;
    font-weight: 500;
  }

  .required {
    color: #f5576c;
    margin-left: 2px;
  }

  .form-input {
    width: 100%;
    padding: 0.9rem 1rem;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    color: #fff;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    outline: none;
  }

  .form-select {
    width: 100%;
    padding: 0.9rem 1rem;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    color: #fff;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    outline: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    padding-right: 40px;
    cursor: pointer;
  }

  .form-select:focus {
    border-color: rgba(255, 255, 255, 0.5);
    background-color: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
  }

  .form-select option {
    background: #3d1520;
    color: #fff;
    padding: 10px;
    border: none;
  }

  .form-select:disabled {
    cursor: not-allowed;
    opacity: 0.6;
    background: rgba(255, 255, 255, 0.05);
  }

  .form-input::placeholder {
    color: rgba(255, 255, 255, 0.4);
  }

  .form-input:focus, .form-select:focus {
    border-color: rgba(255, 255, 255, 0.5);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
  }

  .form-input:hover, .form-select:hover {
    border-color: rgba(240, 147, 251, 0.5);
  }

  .form-input.is-invalid {
    border-color: #f5576c;
    box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.2);
  }

  .invalid-feedback {
    color: #f5576c;
    font-size: 0.75rem;
    margin-top: 0.3rem;
    display: block;
  }

  /* Password toggle */
  .password-wrapper {
    position: relative;
  }

  .password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    padding: 0;
    font-size: 0.9rem;
    transition: color 0.3s ease;
  }

  .password-toggle:hover {
    color: #f093fb;
  }

  /* Botón de registro */
  .btn-register {
    width: 100%;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
    box-shadow: 0 5px 20px rgba(240, 147, 251, 0.3);
  }

  .btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(240, 147, 251, 0.4);
  }

  /* Link de login */
  .login-link {
    text-align: center;
    margin-top: 1.2rem;
    padding-top: 1.2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }

  .login-link a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.85rem;
    transition: color 0.3s ease;
  }

  .login-link a:hover {
    color: #667eea;
  }

  /* Animaciones adicionales */
  .form-input:hover, .form-select:hover {
    border-color: rgba(240, 147, 251, 0.5);
  }

  /* Responsive */
  @media (max-width: 480px) {
    .register-container {
      margin: 1rem;
      padding: 2rem 1.5rem;
      max-width: 100%;
    }

    .form-row {
      grid-template-columns: 1fr;
      gap: 0;
    }

    .form-group.full-width {
      grid-column: span 1;
    }

    .register-title {
      font-size: 1.4rem;
    }
  }
</style>

<body>
  <div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>

  <div class="register-container">
    <!-- Header del register -->
    <div class="register-header">
      <div class="contenederlogoregister" >
        <img src="{{ asset('img/logoblanco.png') }}" alt="" class="imglogoregister">
      </div>
      <h1 class="register-title">Crear Cuenta</h1>
      <p class="register-subtitle">Únete a nuestro sistema de subastas</p>
    </div>

    <!-- Formulario de registro -->
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Primera fila: Documento y Nombre -->
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Documento <span class="required">*</span></label>
          <input type="text" class="form-input" name="documento" placeholder="1234567890" required>
        </div>
        <div class="form-group">
          <label class="form-label">Nombre <span class="required">*</span></label>
          <input 
            id="name" 
            type="text" 
            class="form-input @error('name') is-invalid @enderror" 
            name="name" 
            value="{{ old('name') }}" 
            placeholder="Tu nombre completo" 
            required 
            autocomplete="name" 
            autofocus>
          @error('name')
            <span class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <!-- Segunda fila: Teléfono y Rol -->
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Teléfono <span class="required">*</span></label>
          <input type="tel" class="form-input" name="telefono" placeholder="3123456789" required>
        </div>
        <div class="form-group">
          <label class="form-label">Rol</label>
          <select class="form-select" name="rol">
            <option value="" selected>Seleccione su rol</option>
            <option value="2">Comprador</option>
            <option value="3">Vendedor</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Correo electrónico <span class="required">*</span></label>
        <input 
          id="email" 
          type="email" 
          class="form-input @error('email') is-invalid @enderror" 
          name="email" 
          value="{{ old('email') }}" 
          placeholder="usuario@ejemplo.com" 
          required 
          autocomplete="email">
        @error('email')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Contraseña <span class="required">*</span></label>
        <div class="password-wrapper">
          <input 
            id="password" 
            type="password"
            class="form-input @error('password') is-invalid @enderror"
            name="password" 
            placeholder="Mínimo 8 caracteres" 
            required 
            autocomplete="new-password">
          <button type="button" class="password-toggle" onclick="togglePassword('password')">
            <i class="fas fa-eye"></i>
          </button>
        </div>
        @error('password')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Confirmar contraseña <span class="required">*</span></label>
        <div class="password-wrapper">
          <input 
            id="password-confirm" 
            type="password"
            class="form-input" 
            name="password_confirmation" 
            placeholder="Repetir contraseña" 
            required 
            autocomplete="new-password">
          <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </div>

      <!-- Botón de registro -->
      <button type="submit" class="btn-register">
        {{ __('Registrar Usuario') }}
      </button>

      <!-- Campos ocultos originales -->
      <input type="hidden" name="estado" value="1">
    </form>

    <!-- Link de login -->
    <div class="login-link">
      ¿Ya tienes cuenta? <a href="{{ route('login') }}">{{ __('Ya estoy registrado') }}</a>
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