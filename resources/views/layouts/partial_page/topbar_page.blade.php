<!-- Topbar Start -->
<div class="container-fluid bg-primary px-5 d-none d-lg-block">
  <div class="row gx-0">
    <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
      <div class="d-inline-flex align-items-center" style="height: 45px;">
        
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="{{ asset('twitter.html') }}"><i
            class="fab fa-twitter fw-normal"></i></a>
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="{{ asset('facebookk.html') }}"><i
            class="fab fa-facebook-f fw-normal"></i></a>
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="{{ asset('instagram.html') }}"><i
            class="fab fa-instagram fw-normal"></i></a>

      </div>
    </div>
    <div class="col-lg-4 text-center text-lg-end">
      <div class="d-inline-flex align-items-center" style="height: 45px;">



        @if (Route::has('login'))
  <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}" style="background-color: white;">Home</a>
        @else
              <a href="{{ route('login') }}"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Login</small></a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Register</small></a>
              @endif
        @endauth
  </div>
      @endif

        <!--<div class="dropdown">
          <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i
                class="fa fa-home me-2"></i> My Dashboard</small></a>
          <div class="dropdown-menu rounded">
            <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
            <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
            <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
            <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
            <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
          </div>
        </div>
        -->
      </div>
    </div>
  </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
  <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="" class="navbar-brand p-0">
      <h1 class="m-0 " ><img src="../img/recurso1.png" alt="Logo" >  </h1>
       
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
    <!--
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0">
        <a href="/" class="nav-item nav-link active">Home</a>
        <a href="#" class="nav-item nav-link">About</a>
        <a href="services.html" class="nav-item nav-link">Services</a>
        <a href="packages.html" class="nav-item nav-link">Packages</a>
        <a href="blog.html" class="nav-item nav-link">Blog</a>
        
        <a href="contact.html" class="nav-item nav-link">Contact</a>
      </div>
      <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
    </div>
    -->
  </nav>

</div>
