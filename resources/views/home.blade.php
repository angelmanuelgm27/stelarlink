@extends('layouts.base')

@section('content')
    <section>
        <div class="position-relative">
            <!-- Slider main container -->
            <div class="swiper ">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide w-100"><img class="w-100" src="{{ asset('images/home/banner1.png')}}" alt="banner1"></div>
                    <div class="swiper-slide w-100"><img class="w-100" src="{{ asset('images/home/banner2.png')}}" alt="banner2"></div>
                </div>
            </div>
            <div class="main-content pt-8 z-2">
                <h3 class="text-white text-7xl anta-regular">Conectando</h3>
                <h3 class="text-primary text-5xl anta-regular ">comunidades rurales</h3>
                <p class="text-white text-2xl work-sans-regular ">Transformando vidas a través de la conectividad digital
                    confiable.</p>
                <x-button text="Planes y Precios" :url="('login')"
                    class="btn btn-primary text-3xl px-4 py-2 fw-semibold work-sans-regular rounded-pill w-100"></x-button>
            </div>
        </div>
    </section>
    <section>
        <div class="position-relative m-05-">
            <img src="{{ asset('images/home/imagen_1.jpg') }}" class="w-100" alt="">
            <div class="container">
                <div class="main-content-section-1">
                    <h3 class="text-10xl text-secondary work-sans-regular fw-bold">Internet</h3>
                    <h3 class="text-4-5xl work-sans-regular fw-semibold text-secundary-light">de vanguardia en areas rurales
                    </h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-secondary rounded-7 p-7 my-5">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 col-xl-6 my-auto">
                                <p class="text-5xl text-white work-sans-regular">Estas son las razones para activar hoy tu
                                    conexión
                                    Stelarlink</p>
                                <p class="text-white text-2xl work-sans-regular my-4">"StelarLink se compromete a
                                    proporcionar
                                    soluciones de internet de vanguardia a áreas rurales, ofreciendo conectividad rápida y
                                    confiable
                                    para todos."</p>
                                <p class="text-primary anta-regular text-4xl">¡Te ofrecemos velocidad e innovación</p>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                                <div class="row">
                                    <div class="col-12 col-md-6 my-3">
                                        <div class="bg-white rounded-5 p-3">
                                            <img src="{{ asset('images/home/icons/1.png') }}" class="w-50 d-block mx-auto"
                                                alt="alta velocidad">
                                            <p class="text-secondary text-center anta-regular text-4xl">Alta velocidad</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 my-3">
                                        <div class="bg-white rounded-5 p-3">
                                            <img src="{{ asset('images/home/icons/4.png') }}" class="w-50 d-block mx-auto"
                                                alt="alta velocidad">
                                            <p class="text-secondary text-center anta-regular text-4xl">Energia renovable
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 my-3">
                                        <div class="bg-white rounded-5 p-3">
                                            <img src="{{ asset('images/home/icons/2.png') }}" class="w-50 d-block mx-auto"
                                                alt="alta velocidad">
                                            <p class="text-secondary text-center anta-regular text-4xl">Disfruta sin
                                                latencia
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 my-3">
                                        <div class="bg-white rounded-5 p-3">
                                            <img src="{{ asset('images/home/icons/3.png') }}" class="w-50 d-block mx-auto"
                                                alt="alta velocidad">
                                            <p class="text-secondary text-center anta-regular text-4xl">Conexión 24/7</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="prices">
        <div class="row mt-5">
            <div class="col-12 bg-light-easy">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="py-8">
                                <h3 class="text-center works-sans-regular text-7xl fw-semibold text-secundary-light">
                                    Nuestros planes</h3>
                                <p class="text-2xl mt-7 mx-7 text-secundary-light fw-semibold">Ofrecemos precios
                                    competitivos y
                                    transparentes sin costos
                                    ocultos
                                    ni tarifas adicionales". Opciones de pago: "Aceptamos diferentes métodos de pago para
                                    mayor
                                    comodidad, incluidas transferencias bancarias y pagos en línea</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-7">
                        @foreach ($installation_services as $service)
                            <div class="col-12 col-md-6">
                                <x-installation-plans class="px-4 py-4 bg-secondary rounded-5 m-4 inst-plan"
                                         image="{{ $service->image ? asset('images/services/' . $service->image) : asset('images/noticon.png') }}"
                                         planName="{{ $service->name }}" planPrice="{{ $service->price }}$"
                                         planDescription="{{ $service->description }}">
                                </x-installation-plans>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mb-7">
                        @foreach ($services as $service)
                            <div class="col-12 col-md-6">
                                <x-plans class="px-7 py-5 bg-white rounded-5 m-4"
                                    image="{{ $service->image ? asset('images/services/' . $service->image) : asset('images/noticon.png') }}"
                                    planName="{{ $service->name }}" planPrice="{{ $service->price }}$"
                                    planVelocityLoad="Velocidad de carga {{ $service->velocity_load }} Mbps"
                                    planVelocityDownload='Velocidad de descarga {{ $service->velocity_download }} Mbps'></x-plans>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-me" id="contact">
        <div class="row">
            <div class="col-12">
                <div class="py-9 image-background-fix"
                    style="background-image: url({{ asset('images/home/imagen_2.png') }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 col-xl-4 offset-xl-1">
                                <div>
                                    <p class="work-sans-regular mb-3 text-base text-white text-lg">¿Tienes alguna pregunta o
                                        consulta? Completa nuestro formulario de contacto y nos pondremos en contacto
                                        contigo lo
                                        antes posible".
                                    </p>
                                </div>
                                <form name="form_contact" id="form_contact" class="form-contact">
                                    <div class="mb-3">
                                        <label class="form-label text-white text-2xl">Nombre y apellido</label>
                                        <input required type="text" class="form-control rounded-5 px-3 py-2 text-lg"
                                            id="client_full_name" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-white text-2xl">Telefono</label>
                                        <input required type="text" class="form-control rounded-5 px-3 py-2 text-lg"
                                            id="client_phone" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-white text-2xl">¿ Como podríamos ayudarte ?</label>
                                        <textarea required class="form-control rounded-5 px-3 py-4 text-lg" id="client_description" rows="8"></textarea>
                                    </div>
                                    <button type="submit" form="form_contact"
                                        class="btn btn-primary w-100 text-3xl py-3 rounded-5">Enviar</button>
                                </form>
                                <p class="text-white mt-5 works-sans-regular text-lg">El siguiente mapa muestra la
                                    cobertura de
                                    nuestro servicio, revisa si tu ubicación se encuentra en nuestro radio.</p>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-5 my-auto offset-xl-1">
                                <div>
                                    <p class="anta-regular text-5xl text-white">Conecta con nosotros</p>
                                </div>
                                <div class="d-flex align-items-center my-4 contact-networks">
                                    <div>
                                        <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank"
                                            class="d-block">
                                            <x-icon icon="fas fa-phone-volume"></x-icon>
                                        </a>
                                    </div>
                                    <div>
                                        <p class="m-0 mx-3 text-white work-sans-regular text-3xl">+584245734146</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-4 contact-networks">
                                    <div>
                                        <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank"
                                            class="d-block">
                                            <x-icon icon="fab fa-whatsapp"></x-icon>
                                        </a>
                                    </div>
                                    <div>
                                        <p class="m-0 mx-3 text-white work-sans-regular text-3xl">+584245734146</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-4 contact-networks">
                                    <div>
                                        <a href="https://www.instagram.com/stelarlinkcorp/" target="_blank"
                                            class="d-block">
                                            <x-icon icon="fab fa-instagram"></x-icon>
                                        </a>
                                    </div>
                                    <div>
                                        <p class="m-0 mx-3 text-white work-sans-regular text-3xl">stelarlink</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-4 contact-networks">
                                    <div>
                                        <a href="https://www.facebook.com/profile.php?id=61558148860539" target="_blank"
                                            class="d-block">
                                            <x-icon icon="fab fa-facebook-f"></x-icon>
                                        </a>
                                    </div>
                                    <div>
                                        <p class="m-0 mx-3 text-white work-sans-regular text-3xl">stelarlink</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="coveragemap">
        <div class="row">
            <div class="col-12 col-md-12">
                <x-map :coords="$coordinates"></x-map>
            </div>
        </div>
    </section>
    <section class="about">
        <div class="position-relative m-05-">
            <img src="{{ asset('images/home/imagen_3.jpg') }}" class="w-100" alt="">
            <div class="container">
                <div class="main-content-section-3 h-100 w-50 my-auto">
                    <div class="p-5 position-relative z-1 ms-7 h-100 align-items-center">
                        <div class="d-flex flex-column justify-content-center h-100 me-6">
                            <div class="title-content-3">
                                <h3 class="m-0 text-8xl text-secondary work-sans-regular text-white fw-semibold">Descubre
                                </h3>
                                <h5 class="m-0 text-6xl work-sans-regular text-white fw-semibold mt-2">nuestra historia
                                </h5>
                                <p class="text-2xl work-sans-regular m-0 text-white mt-3">Cómo StelarLink comenzó con la
                                    misión
                                    de
                                    llevar internet de calidad a las zonas rurales".</p>
                            </div>

                            <div class="my-5">
                                <x-button text="Conocenos" url="{{ route('about') }}"
                                    class="btn btn-primary-light px-4 py-3 opacity-90 uppercase w-100 anta-regular rounded-pill text-3xl text-primary"></x-button>
                            </div>

                            <div class="mission-vision">
                                <h3 class="m-0 text-7xl text-secondary work-sans-regular text-white fw-semibold">Nuestra
                                    visión
                                    y
                                    misión</h3>
                                <p class="text-2xl work-sans-regular m-0 text-white mt-3">Nuestra misión es proporcionar
                                    acceso
                                    a
                                    internet rápido y confiable en comunidades rurales, transformando la vida de las
                                    personas a
                                    través de la conectividad.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gallery">
        <div class="row">
            <div class="col-12">
                <div class="py-9">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-4 offset-md-1 my-4">
                                <div>
                                    <h3 class="text-primary work-sans-regular m-0 text-8xl">¡vive</h3>
                                    <h3 class="work-sans-regular m-0 text-5xl text-secondary">la experiencia</h3>
                                    <h3 class="work-sans-regular m-0 text-5xl text-secondary">stelarlink!</h3>
                                </div>
                            </div>
                        </div>
                        <!-- Gallery -->
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-md-6 mb-4 mt-auto mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_1.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Boat on Calm Water" />
                                    </div>

                                    <div class="col-12 col-lg-6 col-md-6 mb-4 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_2.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Mountains in the Clouds" />

                                        <img src="{{ asset('images/home/gallery/image_3.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Mountains in the Clouds" />
                                    </div>
                                    <div class="col-lg-12 mb-4 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_5.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Waves at Sea" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12 col-12 col-md-6 mb-4 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_4.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Waves at Sea" />
                                    </div>
                                    <div class="col-lg-12 col-12 col-md-6 mb-4 mb-lg-0">
                                        <div class="position-relative">
                                            <img src="{{ asset('images/home/gallery/image_6.jpg') }}"
                                                class="w-100 shadow-1-strong rounded-5 mb-4" alt="Waves at Sea" />
                                            <p
                                                class="text-4xl text-white work-sans-regular h-100 fw-semibold px-4 d-flex align-items-center justify-content-center position-absolute top-0 start-0">
                                                CONSEJOS PARA DISFRUTAR MEJOR</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Gallery -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    <section class="team-section" style="background: #311545 no-repeat padding-box;">
        <div class="row">
            <div class="col-12">
                <div class="py-9">
                    <div class="container">
                        <div class="text-center">
                            <div class="col-12 my-4">
                                <div class="">
                                    <h3 class=" text-8xl text-secondary work-sans-regular text-white fw-bolder ">Nuestro equipo</h3>
                                </div>
                            </div>
                            <div class="team-members">
                                <div class="team-member">
                                    <img src="{{ asset('images/home/team/angel_ceo.jpeg')}}" alt="Ángel Garaban">
                                    <h3 class="text-2xl">Ángel Garaban</h3>
                                    <p class="text-xl">Programador</p>
                                    <p class="role text-2xl">CEO</p>
                                    <div class="social-media">
                                        <a href="https://www.instagram.com/angelmanuelgm/" target="_blank">
                                            <x-icons icon="fab fa-instagram"></x-icons>
                                        </a>
                                        <a href="https://www.tiktok.com/@angelgaraban" target="_blank">
                                            <x-icons icon="fab fa-tiktok"></x-icons>
                                        </a>
                                    </div>
                                </div>
                                <div class="team-member">
                                    <img src="{{ asset('images/home/team/josue_coo.jpg')}}" alt="Josue Avila">
                                    <h3 class="text-2xl">Josue Avila</h3>
                                    <p class="text-xl">ING Petroquímico</p>
                                    <p class="role text-2xl">COO</p>
                                    <div class="social-media">
                                        <a href="https://www.instagram.com/AVILA21J/" target="_blank">
                                            <x-icons icon="fab fa-instagram"></x-icons>
                                        </a>
                                        <a href="https://www.tiktok.com/@AVILA21J" target="_blank">
                                            <x-icons icon="fab fa-tiktok"></x-icons>
                                        </a>
                                    </div>
                                </div>
                                <div class="team-member">
                                    <img src="{{ asset('images/home/team/carlos_cto.png')}}" alt="Carlos Oblander">
                                    <h3 class="text-2xl">Carlos Oblander</h3>
                                    <p class="text-xl">Programador</p>
                                    <p class="role text-2xl">CTO</p>
                                    <div class="social-media">
                                        <a href="www.instagram.com/gabrielzinisa/" target="_blank">
                                            <x-icons icon="fab fa-instagram"></x-icons>
                                        </a>
                                        <a href="https://www.tiktok.com/@GABRIELZIN0710" target="_blank">
                                            <x-icons icon="fab fa-tiktok"></x-icons>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Team Section --}}
@endsection
@section('js')
    <script>
        let formContact = document.querySelector('#form_contact');
        formContact.addEventListener('submit', (e) => {
            e.preventDefault();
            let formData = new FormData();
            formData.append('client_full_name', document.querySelector('#client_full_name').value);
            formData.append('client_phone', document.querySelector('#client_phone').value);
            formData.append('client_description', document.querySelector('#client_description').value);

            Swal.fire({
                title: "Stelarlink informa",
                text: "enviando su mensaje por favor espere...",
                icon: "info"
            });
            fetch("{{ route('form.contact') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    if (data.success == true) {
                        Swal.fire({
                            title: "Stelarlink informa",
                            text: "su mensaje ha sido enviado exitosamente!",
                            icon: "success"
                        });
                    } else {
                        console.log(data.message)
                        Swal.fire({
                            title: "Stelarlink informa",
                            text: "hubo un error de envio",
                            icon: "error"
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: "Stelarlink informa",
                        text: "hubo un error de envio",
                        icon: "error"
                    });
                    console.log(error)
                })
        })
    </script>
@endsection
