<footer class="text-center text-lg-start text-muted pt-4 image-background-fix" style="background-image: url('{{ asset('images/footer.png') }} ');">
    <div class="container">
        <section>
            <div class="row justify-content-center mt-5">
                <div class="col-12">
                    <a href="{{ url('/') }}" class="d-block w-30 mx-auto">
                        <img src="{{ asset('images/logo-white.png') }}" class="w-100" alt="stelarlink">
                    </a>
                </div>
            </div>
        </section>

        <section class="">
            <div class="container text-center text-md-start">
                <!-- Grid row -->
                <div class="row mt-5 justify-content-center">
                    <!-- Grid column -->
                    <div class="col-12 col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="fw-light mb-4 text-primary text-3xl">
                            Conectandote
                        </h6>
                        <p>
                            <a href="{{ route('about') }}" class="work-sans-regular fw-light text-white text-xl">¿Por qué
                                elegirnos?</a>
                        </p>
                        <p>
                            <a href="{{ route('home') }}" class="work-sans-regular fw-light text-white text-xl">Planes y
                                servicios</a>
                        </p>
                        <p>
                            <a href="{{ route('home') }}" class="work-sans-regular fw-light text-white text-xl">Mapa de
                                cobertura</a>
                        </p>
                        <p>
                            <a href="/register" class="work-sans-regular fw-light text-white text-xl">Registrate</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="fw-light mb-4 text-primary text-3xl">
                            Vive la experiencia
                        </h6>
                        <p>
                            <a href="{{ route('about') }}" class="work-sans-regular fw-light text-white text-xl">Conocenos</a>
                        </p>
                        <p>
                            <a href="{{ route('home') }}" class="work-sans-regular fw-light text-white text-xl">Precios</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="fw-light mb-4 text-primary text-3xl">Contactanos</h6>
                        <div class="d-flex gap-3 flex-wrap footer-social-networks">
                            <div>
                                <a href="https://www.facebook.com/profile.php?id=61558148860539" class="d-block" target="_blank">
                                    <x-icon icon="fab fa-facebook-f"></x-icon>
                                </a>
                            </div>
                            <div>
                                <a href="https://www.instagram.com/stelarlinkcorp/" class="d-block" target="_blank">
                                    <x-icon icon="fab fa-instagram"></x-icon>
                                </a>
                            </div>
                            <div>
                                <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank">
                                    <x-icon icon="fas fa-phone-volume"></x-icon>
                                </a>
                            </div>
                            <div>
                                <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank">
                                    <x-icon icon="fab fa-whatsapp"></x-icon>
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
        <div class="text-center p-4 text-white border-top">
            © {{ date('Y') }} Copyright:
            <a class="text-reset fw-bold" href="https://www.instagram.com/stelarlinkcorp/">stelarlink.com</a>
        </div>
        <!-- Copyright -->
    </div>
</footer>
