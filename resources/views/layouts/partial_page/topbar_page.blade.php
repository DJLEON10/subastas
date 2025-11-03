<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .topbar-custom {
        background: linear-gradient(135deg, #1a202c 80%, #2d3748 80%);
        padding: 10px 0;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
    }

    .topbar-custom a {
        color: #ffffff;
        text-decoration: none;
        padding: 8px 16px;
        margin: 0 4px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .topbar-custom a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .topbar-custom .dropdown-toggle {
        background: rgba(255, 255, 255, 0.15);
        padding: 8px 16px;
        border-radius: 6px;
    }

    .topbar-custom .dropdown-toggle:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .topbar-custom .dropdown-menu {
        background: #ffffff;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 8px;
        margin-top: 8px;
    }

    .topbar-custom .dropdown-item {
        padding: 10px 16px;
        border-radius: 6px;
        color: #333;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .topbar-custom .dropdown-item:hover {
        background: #f5f5f5;
        color: #8b0000;
        padding-left: 24px;
    }

    .topbar-custom .dropdown-item i {
        margin-right: 10px;
        color: #8b0000;
        width: 20px;
        text-align: center;
    }

    .navbar-custom {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        padding: 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-custom .navbar-brand {
        padding: 10px 0;
    }

    .navbar-custom .navbar-brand img {
        height: 55px;
        transition: all 0.3s ease;
        filter: brightness(1.1);
    }

    .navbar-custom .navbar-brand:hover img {
        transform: scale(1.1);
    }

    .navbar-custom .navbar-toggler {
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 10px 12px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-custom .navbar-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    }

    .navbar-custom .navbar-toggler .fa-bars {
        color: #ffffff;
        font-size: 20px;
    }

    .navbar-custom .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        padding: 28px 20px !important;
        font-weight: 500;
        font-size: 16px;
        position: relative;
        transition: all 0.3s ease;
    }

    .navbar-custom .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #ffd700 0%, #ffb300 100%);
        transform: translateX(-50%);
        transition: width 0.4s ease;
        border-radius: 2px;
    }

    .navbar-custom .nav-link:hover {
        color: #ffd700 !important;
    }

    .navbar-custom .nav-link:hover::before {
        width: 70%;
    }

    .navbar-custom .nav-link.active {
        color: #ffd700 !important;
    }

    .navbar-custom .nav-link.active::before {
        width: 70%;
    }

    .navbar-custom .btn-book {
        background: linear-gradient(135deg, #ffd700 0%, #ffb300 100%) !important;
        color: #1a1a1a !important;
        border: none !important;
        padding: 12px 32px !important;
        font-weight: 600;
        font-size: 15px;
        border-radius: 50px !important;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .navbar-custom .btn-book:hover {
        background: linear-gradient(135deg, #ffb300 0%, #ff9800 100%) !important;
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(255, 215, 0, 0.6);
    }

    @media (max-width: 991px) {
        .navbar-custom .navbar-collapse {
            background: rgba(45, 55, 72, 0.98);
            margin-top: 15px;
            border-radius: 12px;
            padding: 15px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .navbar-custom .nav-link {
            padding: 12px 20px !important;
            border-left: 3px solid transparent;
        }

        .navbar-custom .nav-link::before {
            display: none;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            background: rgba(255, 215, 0, 0.1);
            border-left-color: #ffd700;
        }

        .navbar-custom .btn-book {
            margin: 15px 20px !important;
            display: block;
            text-align: center;
        }
    }
</style>

<!-- Topbar Start -->
<div class="container-fluid px-5 d-none d-lg-block topbar-custom">
  <div class="row gx-0">
    <div class="col-lg-12 text-end">
      <div class="d-inline-flex align-items-center" style="height: 45px; ">
        
        @if (Route::has('login'))
          <div class="d-flex align-items-center">
            @auth
              <a href="{{ url('/home') }}">
                <i class="fa fa-home me-2"></i>Home
              </a>
            @else
              <a href="{{ route('login') }}">
                <i class="fa fa-user me-2"></i>Login
              </a>

              @if (Route::has('register'))
                <a href="{{ route('register') }}">
                  <i class="fa fa-sign-in-alt me-2"></i>Register
                </a>
              @endif
            @endauth
          </div>
        @endif

        <div class="dropdown ms-3">
          <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-th-large me-2"></i>My Dashboard
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a href="#" class="dropdown-item">
              <i class="fas fa-user-alt"></i>My Profile
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-comment-alt"></i>Inbox
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-bell"></i>Notifications
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-cog"></i>Account Settings
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-power-off"></i>Log Out
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid position-relative p-0">
  <nav class="navbar navbar-expand-lg navbar-custom px-4 px-lg-5 py-3 py-lg-0">
    <a href="/" class="navbar-brand p-0">
      <img src="../img/logoblanco.png" alt="Logo">
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0">
        <a href="/" class="nav-item nav-link active">Home</a>
        <a href="#" class="nav-item nav-link">About</a>
        <a href="services.html" class="nav-item nav-link">Services</a>
        <a href="contact.html" class="nav-item nav-link">Contact</a>
      </div>
      <a href="#" class="btn btn-book ms-lg-4">Book Now</a>
    </div>
  </nav>
</div>
<!-- Navbar End -->