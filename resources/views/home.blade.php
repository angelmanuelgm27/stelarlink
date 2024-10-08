@extends('layouts.base')

@section('content')
    <section>
        <div class="position-relative">
            <div class="main-banner">

                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide w-100"><img class="w-100" src="{{ asset('images/home/banner1.png')}}" alt="banner1"></div>
                        <div class="swiper-slide w-100"><img class="w-100" src="{{ asset('images/home/banner2.png')}}" alt="banner2"></div>
                    </div>
                </div>
            </div>

            <div class="main-banner-responsive">
                <img src="{{ asset('images/home/responsive/banner-resposive.png') }}" style="width: 100%" alt="main">
            </div>

            <div class="main-content pt-8 z-2">
                <h3 class="text-white text-7xl anta-regular">Conectando</h3>
                <h3 class="text-primary text-5xl anta-regular ">comunidades rurales</h3>
                <p class="text-white text-2xl work-sans-regular ">Transformando vidas a través de la conectividad digital
                    confiable.</p>
                <x-button text="Planes y Precios" :url="('login')"
                    class="btn btn-primary-light text-3xl px-4 py-2 fw-semibold work-sans-regular rounded-pill w-100"></x-button>
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
                            <div class="col-12 col-md-12 col-lg-12 col-xl-6 my-auto text-xl-start text-center">
                                <p class="text-5xl text-white  work-sans-regular">Estas son las razones para activar hoy tu
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
                            <div class="py-5">
                                <h3 class="text-10xl text-secondary text-center work-sans-regular fw-bold">Planes</h3>
                                <h3 class="text-center works-sans-regular text-5xl fw-semibold text-secundary-light">
                                    de instalación</h3>
                                <p class="text-2xl mt-7 mx-7 text-md-center text-start text-secundary-light fw-semibold">Ofrecemos precios
                                    competitivos y
                                    transparentes sin costos
                                    ocultos
                                    ni tarifas adicionales". <br> <br> Opciones de pago: "Aceptamos diferentes métodos de pago para
                                    mayor
                                    comodidad, incluidas transferencias bancarias y pagos en línea</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-7">
                        @foreach ($installation_services as $iservice)
                            <div class="col-12 col-md-6">
                                <x-installation-plans class="px-4 px-lg-5 py-4 bg-secondary rounded-5 m-2 inst-plan"
                                    image="{{ $iservice->image ? asset('images/services/' . $iservice->image) : asset('images/noticon.png') }}"
                                    planName="{{ $iservice->name }}" planPrice="{{ $iservice->price }}$"
                                    planCategory="{{ $iservice->category }}"
                                    planDescription="{{ $iservice->description }}">
                                </x-installation-plans>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="py-8">
                                <h3 class="text-10xl text-secondary text-center work-sans-regular fw-bold">Planes</h3>
                                <h3 class="text-center works-sans-regular text-5xl fw-semibold text-secundary-light">
                                    de suscripción</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-7">
                        @foreach ($services as $service)
                            <div class="col-12 col-md-6">
                                <x-plans class="px-4 px-lg-6 py-5 bg-white rounded-5 m-4"
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
                    style="background-image: url({{ asset('images/home/banner-contacto.png') }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 col-xl-4 offset-xl-1">
                                <div>
                                    <p class="work-sans-light mb-3 text-base text-white text-lg">¿Tienes alguna pregunta o
                                        consulta? Completa nuestro formulario de contacto y nos pondremos en contacto
                                        contigo lo
                                        antes posible".
                                    </p>
                                </div>
                                <form name="form_contact" id="form_contact" class="form-contact">
                                    <div class="mb-3">
                                        <label class="form-label text-white text-2xl">Nombre y apellido</label>
                                        <input required type="text" class="form-control rounded-5 px-5  py-2 text-lg"
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
                                <p class="text-white mt-5 work-sans-light text-lg">El siguiente mapa muestra la
                                    cobertura de
                                    nuestro servicio, <span class="work-sans-semibold"> revisa si tu ubicación se encuentra en nuestro radio. </span> </p>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mt-auto offset-xl-1 mb-3">
                                <div>
                                    <p class="work-sans-semibold text-5xl text-white">¡Conecta con nosotros!</p>
                                </div>
                                <div class="d-flex align-items-center my-4 contact-networks">
                                    <div>
                                        <a href="tel:+584245734146" target="_blank"
                                            class="d-block">
                                            <x-icon-primary icon="fas fa-phone-volume"></x-icon-primary>
                                        </a>
                                    </div>
                                    <div>
                                        <p class="m-0 mx-3 text-white work-sans-semibold text-3xl">+584245734146</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-4 contact-networks">
                                    <div>
                                        <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank"
                                            class="d-block">
                                            <x-icon-primary icon="fab fa-whatsapp"></x-icon-primary>
                                        </a>
                                    </div>
                                    <div>
                                        <p class="m-0 mx-3 text-white work-sans-semibold text-3xl">+584245734146</p>

                                    </div>
                                </div>

                                <div class="d-flex flex-row mt-3 justify-content-end me-6">

                                    <div class="d-flex align-items-center mx-1 my-4 contact-networks">
                                        <div>
                                            <a href="https://www.instagram.com/stelarlinkcorp/" target="_blank"
                                                class="d-block">
                                                <x-icon-primary icon="fab fa-instagram"></x-icon-primary>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mx-1 my-4 contact-networks">
                                        <div>
                                            <a href="https://www.facebook.com/profile.php?id=61558148860539" target="_blank"
                                                class="d-block">
                                                <x-icon-primary icon="fab fa-facebook-f"></x-icon-primary>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mx-1 my-4 contact-networks">
                                        <div>
                                            <a href="https://tiktok.com/@stelarlinkcorp" target="_blank"
                                                class="d-block">
                                                <x-icon-primary icon="fab fa-tiktok"></x-icon-primary>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mx-1 my-4 contact-networks">
                                        <div>
                                            <a href="https://x.com/stelarlinkcorp" target="_blank"
                                                class="d-block">
                                               <x-icon-primary icon="fab fa-twitter">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                                        </svg>
                                               </x-icon-primary>

                                            </a>
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
                <div class="py-8">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 my-2 mx-auto">
                                <div>
                                    <h3 class="text-primary work-sans-extrabold m-0 text-12xl text-center">¡Vive!</h3>
                                    <h3 class="work-sans-semibold text-5xl text-secondary py-4 text-center ">la experiencia</h3>
                                </div>
                            </div>
                        </div>
                        <!-- Gallery -->
                        <div class="row d-none d-lg-flex">
                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="row">
                                    <div class="col-6 col-lg-6 col-md-6 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_1.jpg') }}"
                                            class="w-100 h-90 shadow-1-strong rounded-5 " alt="Boat on Calm Water" />
                                    </div>

                                    <div class="col-6 col-lg-6 col-md-6 mb-4 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_2.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Mountains in the Clouds" />

                                        <img src="{{ asset('images/home/gallery/image_3.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Mountains in the Clouds" />
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
                                        <img src="{{ asset('images/home/gallery/image_5.jpg') }}"
                                            class="w-100 h-gallery h-lg-gallery  shadow-1-strong rounded-5 mb-4 " alt="Waves at Sea" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Gallery RESPONSIVE-->
                          <div class="row d-lg-none d-flex ">
                            <div class="col-12  col-lg-8">
                                <div class="row">
                                    <div class="col-4 col-lg-6 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_1.jpg') }}"
                                            class="w-100 h-80 shadow-1-strong rounded-5 " alt="Boat on Calm Water" />
                                    </div>

                                    <div class="col-8 col-lg-6 mb-4 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_2.jpg') }}"
                                            class="w-100 shadow-1-strong rounded-5 mb-4" alt="Mountains in the Clouds" />

                                    </div>
                                </div>
                            </div>
                            <div class="col-12  col-lg-4 ">
                                <div class="row">


                                    <div class="col-lg-12 col-8 mb-4 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_5.jpg') }}"
                                            class="w-100 h-100  shadow-1-strong rounded-5 mb-4 " alt="Waves at Sea" />
                                    </div>
                                    <div class="col-lg-12 col-4 mb-4 mb-lg-0">
                                        <img src="{{ asset('images/home/gallery/image_4.jpg') }}"
                                            class="w-100 h-100 shadow-1-strong rounded-5 mb-4" alt="Waves at Sea" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-lg-0">

                                        <img src="{{ asset('images/home/gallery/image_3.jpg') }}"
                                            class="w-100 h-60  shadow-1-strong rounded-5 mb-4 col-12" alt="Mountains in the Clouds" />
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
                                            <x-icon-secondary icon="fab fa-instagram"></x-icon-secondary>
                                        </a>
                                        <a href="https://www.tiktok.com/@angelgaraban" target="_blank">
                                            <x-icon-secondary icon="fab fa-tiktok"></x-icon-secondary>
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
                                            <x-icon-secondary icon="fab fa-instagram"></x-icon-secondary>
                                        </a>
                                        <a href="https://www.tiktok.com/@AVILA21J" target="_blank">
                                            <x-icon-secondary icon="fab fa-tiktok"></x-icon-secondary>
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
                                            <x-icon-secondary icon="fab fa-instagram"></x-icon-secondary>
                                        </a>
                                        <a href="https://www.tiktok.com/@GABRIELZIN0710" target="_blank">
                                            <x-icon-secondary icon="fab fa-tiktok"></x-icon-secondary>
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
