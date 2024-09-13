@extends('layouts.base')

@section('content')
    <div class="position-relative bg-secondary about-head">

        <div class="main-content w-100 start-0">
            <h3 class="text-white text-7xl work-sans-regular fw-semibold text-center">¿Como empezó todo?</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 my-3 my-lg-5">
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
                            <x-icon-primary icon="fab fa-facebook-f border border-primary"></x-icon-primary>
                        </a>
                    </div>
                    <div>
                        <a href="#" class="d-block">
                            <x-icon-primary icon="fab fa-instagram border border-primary"></x-icon-primary>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <x-icon-primary icon="fas fa-phone-volume border border-primary"></x-icon-primary>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <x-icon-primary icon="fab fa-whatsapp border border-primary"></x-icon-primary>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                        <a href="https://api.whatsapp.com/send?phone=584245734146" target="_blank"
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
                                            <a href="https://www.instagram.com/stelarlinkcorp/" target="_blank"
                                               class="d-block">
                                                <x-icon-primary icon="fab fa-tiktok"></x-icon-primary>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mx-1 my-4 contact-networks">
                                        <div>
                                            <a href="https://www.facebook.com/profile.php?id=61558148860539" target="_blank"
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
    <div class="row">

        <div class="col-12 col-md-12">
            <x-map :coords="$coordinates"></x-map>
        </div>
    </div>
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
