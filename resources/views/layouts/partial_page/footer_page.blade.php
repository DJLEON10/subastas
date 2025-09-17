<!-- Footer Start -->
<div class="container-fluid footer py-5" style="background-color:var(--bs-dark) ; width: 100%;  ">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Nuestra Misión</h4>
                    <p class="text-white">Ofrecer apoyo integral a personas en situación de calle mediante alimentación, orientación, salud, capacitación y acompañamiento.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-3 text-white">Nuestra Visión</h4>
                    <p class="text-white">Ser una organización líder en la transformación social, brindando oportunidades dignas y sostenibles para la reintegración plena a la sociedad.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section with Map Start -->
    <div class=" py-5" style="width: 100%;">
        <div class="row g-5">
            <!-- Formulario -->
            <div class="col-lg-6">
                <h2 class="mb-4">Contáctanos</h2>
                <form action="https://formsubmit.co/djleonm@ufpso.edu.co" method="POST" >
                    <!-- Configuraciones ocultas -->
                    <input type="hidden" name="_subject" value="Nuevo mensaje del formulario">
                    <input type="hidden" name="_next" value="{{ asset('gracias.html') }}">


                    <!-- Campo: Nombre -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre completo" required>
                    </div>

                    <!-- Campo: Correo -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="tu@email.com" required>
                    </div>

                    <!-- Campo: Mensaje -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                </form>
            </div>

            <!-- Mapa -->
            <div class="col-lg-6">
                <h2 class="mb-4">Nuestra Ubicación</h2>
                <div class="ratio ratio-4x3 rounded shadow">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.541070568231!2d-73.35223548523712!3d8.244867394104094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e665c9adbd5c3f3%3A0x74a4287c5c1c2549!2zT2Nhw6FuLCBOb3J0ZSBkZSBTYW50YW5kZXIsIENvbG9tYmlh!5e0!3m2!1ses!2sco!4v1714592020370!5m2!1ses!2sco"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section with Map End -->

    <div class=" py-5">
        <div class="row g-5" style="display: flex; justify-content: left; align-items: center;">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">CONTACTA CON NOSOTROS</h4>
                    <a href=""><i class="fas fa-home me-2"></i> Ocaña/Norte de Sanatnder </a>
                    <a href=""><i class="fas fa-envelope me-2"></i> jfbenavider@ufpso.edu.co</a>
                    <a href=""><i class="fas fa-phone me-2"></i> 3183808041</a>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-share fa-2x text-white me-2"></i>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="{{ asset('facebookk.html') }}"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="{{ asset('twitter.html') }}">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="{{ asset('instagram.html') }}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright text-body py-4">
    <div class="">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-end mb-md-0">
                <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
            </div>
            <div class="col-md-6 text-center text-md-start">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Copyright End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>