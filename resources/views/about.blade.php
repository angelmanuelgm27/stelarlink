@extends('layouts.base')

@section('content')
    <div class="position-relative">
        <img src="{{ asset('images/about/main.jpg') }}" class="w-100" alt="">
        <div class="main-content w-100 start-0">
            <h3 class="text-white text-7xl work-sans-regular fw-semibold text-center">¿Como empezó todo?</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 my-4">
                <p class="text-xl work-sans-regular">Hace años, en las vastas extensiones de las zonas rurales, surgió una
                    necesidad imperiosa: la conexión. Aunque el internet estaba presente, su calidad era deficiente,
                    limitando el crecimiento y el progreso. Cuatro jóvenes, arraigados a su tierra natal, compartían una
                    visión audaz: llevar el poder del internet a cada rincón, donde la conectividad parecía un sueño lejano.
                </p>
                <p class="text-xl work-sans-regular">Con valentía y determinación, dieron vida a StelarLink. Inspirados por
                    la misión de transformar la vida en las comunidades rurales a través de la conectividad, estos
                    visionarios se propusieron un objetivo ambicioso: proporcionar acceso a internet rápido y confiable, sin
                    importar lo remoto del lugar. Con cada antena levantada y cada conexión establecida, StelarLink se
                    convirtió en más que una empresa; se convirtió en un símbolo de esperanza y progreso.</p>
                <p class="text-xl work-sans-regular">El camino no fue fácil. Se enfrentaron a desafíos técnicos y
                    logísticos, pero su dedicación nunca flaqueó. Movidos por una visión compartida y el apoyo
                    inquebrantable de sus familias y amigos, StelarLink creció, expandiéndose más allá de las fronteras de
                    su comunidad natal. Con el tiempo, la visión de StelarLink evolucionó. Más que simplemente proporcionar
                    conexión, se comprometieron a enriquecer la vida de las personas, brindando oportunidades y recursos a
                    aquellos que alguna vez estuvieron desconectados.</p>
                <p class="text-xl work-sans-regular">Hoy, StelarLink sigue siendo fiel a sus raíces, pero mira hacia el
                    futuro con optimismo y determinación. Cada conexión establecida, cada comunidad conectada, es un
                    testimonio del espíritu pionero de StelarLink. Y aunque el viaje apenas está comenzando, el compromiso
                    de la empresa de transformar el mundo rural con el poder del internet sigue siendo más fuerte que nunca.
                </p>
            </div>
            <div class="col-12 my-4">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <img src="{{ asset('images/jobs/image_1.jpg') }}" class="w-100 rounded-5 my-3" alt="">
                        <img src="{{ asset('images/jobs/image_4.jpg') }}" class="w-100 rounded-5 my-3" alt="">
                    </div>
                    <div class="col-12 col-md-4">
                        <img src="{{ asset('images/jobs/image_2.jpg') }}" class="w-100 rounded-5 my-3" alt="">
                    </div>
                    <div class="col-12 col-md-4">
                        <img src="{{ asset('images/jobs/image_3.jpg') }}" class="w-100 rounded-5 my-3" alt="">
                        <img src="{{ asset('images/jobs/image_5.jpg') }}" class="w-100 rounded-5 my-3" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <p class="text-xl work-sans-regular">Misión y Visión: "Nuestra misión es proporcionar acceso a internet
                    rápido y confiable en comunidades
                    rurales, transformando la vida de las personas a través de la conectividad". Equipo: "Conoce al equipo
                    detrás de StelarLink, apasionados por conectar el mundo rural con el poder del internet."</p>
            </div>
            <div class="col-12 col-md-3 col-lg-3 col-xl-3 my-4">
                <!-- Links -->
                <div class="d-flex gap-3">
                    <div>
                        <a href="#" class="d-block">
                            <x-icon icon="fab fa-facebook-f border border-primary"></x-icon>
                        </a>
                    </div>
                    <div>
                        <a href="#" class="d-block">
                            <x-icon icon="fab fa-instagram border border-primary"></x-icon>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <x-icon icon="fas fa-phone-volume border border-primary"></x-icon>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <x-icon icon="fab fa-whatsapp border border-primary"></x-icon>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <h3 class="work-sans-regular text-7xl text-center my-7 mx-3">Mapa de cobertura</h3>
        </div>
        <div class="col-12 col-md-12">
            <x-map :coords="$coordinates"></x-map>
        </div>
    </div>
@endsection
