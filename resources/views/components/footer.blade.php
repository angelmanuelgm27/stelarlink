<footer class="text-center text-lg-start text-muted pt-4 image-background-fix-footer" style="background-image: url('{{ asset('images/footer.png') }} ')">
    <div class="container">
        <section>
            <div class="row justify-content-center mt-4">

                    <a href="{{ url('/') }}" class="d-block w-50 mx-auto grid">
                        <img src="{{ asset('images/logo-simple.png') }}" class="w-2X" alt="stelarlink">
                    </a>

            </div>
        </section>

        <section class="">
            <div class="container text-center text-md-start">
                <!-- Grid row -->
                <div class="row my-10 justify-content-center">
                    <!-- Grid column -->
                    <div class="col-12 col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="work-sans-semibold mb-4 text-primary text-2xl">
                            Conectandote
                        </h6>
                        <p>
                            <a href="{{ route('about') }}" class="work-sans-light  text-white text-xl">¿Por qué
                                elegirnos?</a>
                        </p>
                        <p>
                            <a href="{{ route('home') }}" class="work-sans-light  text-white text-xl">Planes y
                                servicios</a>
                        </p>
                        <p>
                            <a href="{{ route('home') }}" class="work-sans-light text-white text-xl">Mapa de
                                cobertura</a>
                        </p>
                        <p>
                            <a href="/register" class="work-sans-light  text-white text-xl">Registrate</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="work-sans-semibold mb-4 text-primary text-2xl">
                            Vive la experiencia
                        </h6>
                        <p>
                            <a href="{{ route('about') }}" class="work-sans-regular text-white text-xl">Conocenos</a>
                        </p>
                        <p>
                            <a href="{{ route('home') }}" class="work-sans-regular text-white text-xl">Precios</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="work-sans-semibold mb-4 text-primary text-2xl">Contactanos</h6>
                        <div class="d-flex gap-3 flex-wrap footer-social-networks">
                            <div>
                                <a href="https://www.facebook.com/profile.php?id=61558148860539" class="d-block" target="_blank">
                                    <x-icon-primary icon="fab fa-facebook-f"></x-icon-primary>
                                </a>
                            </div>
                            <div>
                                <a href="https://www.instagram.com/stelarlinkcorp/" class="d-block" target="_blank">
                                    <x-icon-primary icon="fab fa-instagram"></x-icon-primary>
                                </a>
                            </div>
                            <div>
                                <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank">
                                    <x-icon-primary icon="fab fa-tiktok"></x-icon-primary>
                                </a>
                            </div>
                            <div>
                                <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank">
                                    <x-icon-primary icon="fab fa-twitter"></x-icon-primary>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center mb-5  ">
            <a class="work-sans-light text-2xl text-white " >Stelarlink Derechos reservados 2024</a>
        </div>
        <!-- Copyright -->
    </div>
</footer>
