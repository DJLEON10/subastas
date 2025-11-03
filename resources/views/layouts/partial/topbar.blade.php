
<nav class="main-header navbar navbar-expand navbar-white navbar-light completo">
    <ul class="navbar-nav" style="color: white;">
		<li class="nav-item" style="color: white;">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: white;"></i></a>
		</li>
    </ul>
	<div style="color: white; margin-left: 5px;">
	<h1 class="m-0">SubasGo </h1>
	<p>Siempre tu mejor opcion</p>
	</div>
	
    <ul class="navbar-nav ml-auto">
		<div class="user-panel mt-2 pb-3 d-flex">
    <div class="image">
        @php
        $userPhotoPath = 'uploads/users/' . Auth::user()->photo;
        @endphp
        @if (!empty(Auth::user()->photo) && file_exists(public_path($userPhotoPath)))
        <img class="img-circle elevation-2" src="{{ asset($userPhotoPath) }}" alt="{{ Auth::user()->name }}" style="width: 35px; height: 35px;">
        @else
        <img src="{{ asset('backend/dist/img/avatar5.png') }}" class="img-circle elevation-2" style="width: 35px; height: 35px;" alt="">
        @endif 
      </div>
			<div class="info" style="color:white">
				{{ Auth::user()->name }}
			</div>
		</div>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Cerrar Sesión" role="button">
				<i class='fas fa-power-off' style='font-size:24px; color:red'></i>
			</a>
			<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
				@csrf
			</form>
		</li>
    </ul>
</nav>


